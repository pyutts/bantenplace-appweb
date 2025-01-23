<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemsModel extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getItemsWithProducts($orderId)
    {
        return $this->select('
            order_items.*,
            products.name_products,
            products.gambar_products,
            products.description
        ')
        ->join('products', 'products.id = order_items.product_id')
        ->where('order_id', $orderId)
        ->findAll();
    }

    // Calculate order subtotal
    public function getOrderSubtotal($orderId)
    {
        $result = $this->selectSum('price * quantity', 'subtotal')
                      ->where('order_id', $orderId)
                      ->first();
        return $result ? $result['subtotal'] : 0;
    }
} 