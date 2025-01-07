<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;

class CartController extends BaseController
{
    protected $cartModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
    }

    public function index()
    {
        $userId = session()->get('user_id'); // Assuming you have user session
        $cartItems = $this->cartModel->getCartItems($userId);

        return view('homepages/cart', ['cartItems' => $cartItems]);
    }

    public function updateQuantity($cartId, $quantity)
    {
        $this->cartModel->update($cartId, ['quantity' => $quantity]);
        return redirect()->to('/cart');
    }

    public function removeItem($cartId)
    {
        $this->cartModel->delete($cartId);
        return redirect()->to('/cart');
    }
}