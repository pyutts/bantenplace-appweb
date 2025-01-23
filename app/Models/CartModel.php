<?php

namespace App\Models;

use CodeIgniter\Model;


class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'product_id', 'quantity'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getCartItems($userId)
    {
        return $this->select('cart.id as cart_id, cart.quantity, cart.user_id, cart.product_id, 
                            products.name_products, products.price, products.gambar_products, products.stock')
                    ->join('products', 'products.id = cart.product_id')
                    ->where('cart.user_id', $userId)
                    ->findAll();
    }

    public function addItem($data)
    {
        // Check if item already exists in cart
        $existingItem = $this->where([
            'user_id' => $data['user_id'],
            'product_id' => $data['product_id']
        ])->first();

        if ($existingItem) {
            // Update quantity if item exists
            $newQuantity = $existingItem['quantity'] + $data['quantity'];
            return $this->update($existingItem['id'], ['quantity' => $newQuantity]);
        }

        // Insert new item if it doesn't exist
        return $this->insert($data);
    }

    public function updateQuantity($cartId, $quantity)
    {
        return $this->update($cartId, ['quantity' => $quantity]);
    }

    public function getCartTotal($userId)
    {
        $items = $this->getCartItems($userId);
        $total = 0;
        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}