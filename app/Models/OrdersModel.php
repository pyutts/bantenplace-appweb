<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['order_id', 'user_id', 'product_id', 'quantity', 'total_price', 'status', 'payment_method', 'ekspedisi_id', 'created_at', 'updated_at'];

    protected $beforeInsert = ['generateUniqueOrderId'];
    protected $beforeUpdate = ['checkStatus'];

    protected function generateUniqueOrderId(array $data)
    {
        $data['data']['order_id'] = $this->generateUniqueCode();
        return $data;
    }

    private function generateUniqueCode()
    {
        $date = date('Ymd');
        $randomNumber = mt_rand(1000, 9999);
        return 'ORD-' . $date . '-' . $randomNumber;
    }

    protected function checkStatus(array $data)
    {
        if (isset($data['data']['status']) && $data['data']['status'] === 'Selesai') {
            $this->reduceStock($data['id'][0]);
        }
        return $data;
    }

    private function reduceStock($orderId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('orders');
        $order = $builder->where('id', $orderId)->get()->getRowArray();

        if ($order) {
            $productBuilder = $db->table('products');
            $product = $productBuilder->where('id', $order['product_id'])->get()->getRowArray();

            if ($product) {
                $newStock = $product['stock'] - $order['quantity'];
                $productBuilder->where('id', $product['id'])->update(['stock' => $newStock]);
            }
        }
    }
}