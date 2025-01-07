<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'product_id', 'quantity', 'created_at', 'updated_at'];

    public function getCartItems($userId)
    {
        return $this->select('cart.*, products.name_products, products.price, products.gambar_products')
                    ->join('products', 'products.id = cart.product_id')
                    ->where('cart.user_id', $userId)
                    ->findAll();
    }
}