<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'order_id', 'user_id', 'product_id', 'quantity', 
        'total_price', 'status', 'payment_method_id', 
        'ekspedisi_id', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;

    protected $beforeInsert = ['generateOrderId'];

    protected function generateOrderId(array $data)
    {
        $date = date('Ymd');
        $randomNumber = mt_rand(1000, 9999);
        $data['data']['order_id'] = 'ORD-' . $date . '-' . $randomNumber;
        return $data;
    }

    public function createOrder($userId, $cartItems, $totalAmount, $paymentMethodId, $ekspedisiId)
    {
        $orderData = [
            'user_id' => $userId,
            'product_id' => $cartItems[0]['product_id'], // Ambil produk pertama
            'quantity' => $cartItems[0]['quantity'],
            'total_price' => $totalAmount,
            'status' => 'pending',
            'payment_method_id' => $paymentMethodId,
            'ekspedisi_id' => $ekspedisiId
        ];

        return $this->insert($orderData);
    }

    public function getOrdersByUser($userId)
    {
        return $this->select('orders.*, products.name_products, products.gambar_products, 
                         products.price, payment_methods.name as payment_method, 
                         ekspedisi.nama_ekspedisi, ekspedisi.harga_ongkir')
            ->join('products', 'products.id = orders.product_id')
            ->join('payment_methods', 'payment_methods.id = orders.payment_method_id')
            ->join('ekspedisi', 'ekspedisi.id = orders.ekspedisi_id')
            ->where('orders.user_id', $userId)
            ->orderBy('orders.created_at', 'DESC')
            ->findAll();
    }

    public function getOrderDetail($orderId)
    {
        return $this->select('
            orders.*, 
            users.nama, users.alamat, users.no_telepon,
            products.name_products, products.gambar_products,
            ekspedisi.nama_ekspedisi, ekspedisi.harga_ongkir,
            payment_methods.name as payment_method_name,
            payment_details.payment_status, payment_details.transaction_id
        ')
        ->join('users', 'users.id = orders.user_id')
        ->join('products', 'products.id = orders.product_id')
        ->join('ekspedisi', 'ekspedisi.id = orders.ekspedisi_id')
        ->join('payment_methods', 'payment_methods.id = orders.payment_method_id')
        ->join('payment_details', 'payment_details.order_id = orders.id', 'left')
        ->where('orders.id', $orderId)
        ->first();
    }

    public function updateStatus($orderId, $status)
    {
        return $this->update($orderId, [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function getUserOrders($userId)
    {
        return $this->select('
            orders.*, 
            products.name_products, products.gambar_products,
            ekspedisi.nama_ekspedisi,
            payment_methods.name as payment_method_name,
            payment_details.payment_status
        ')
        ->join('products', 'products.id = orders.product_id')
        ->join('ekspedisi', 'ekspedisi.id = orders.ekspedisi_id')
        ->join('payment_methods', 'payment_methods.id = orders.payment_method_id')
        ->join('payment_details', 'payment_details.order_id = orders.id', 'left')
        ->where('orders.user_id', $userId)
        ->orderBy('orders.created_at', 'DESC')
        ->findAll();
    }

    // Mengambil riwayat pesanan berdasarkan user_id
    public function getOrderHistory($userId)
    {
        return $this->select('orders.*, products.name_products, products.gambar_products, 
                         products.price, payment_methods.name as payment_method, 
                         ekspedisi.nama_ekspedisi, ekspedisi.harga_ongkir')
            ->join('products', 'products.id = orders.product_id')
            ->join('payment_methods', 'payment_methods.id = orders.payment_method_id')
            ->join('ekspedisi', 'ekspedisi.id = orders.ekspedisi_id')
            ->where('orders.user_id', $userId)
            ->orderBy('orders.created_at', 'DESC')
            ->findAll();
    }
}