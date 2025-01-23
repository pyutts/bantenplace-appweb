<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\ProductsModel;
use App\Models\EkspedisiModel;
use App\Models\UsersModel;
use App\Models\OrdersModel;
use App\Models\PaymentMethodModel;
use App\Models\PaymentDetailModel;
use Dompdf\Dompdf;

class CartController extends BaseController
{
    protected $cartModel;
    protected $productModel;
    protected $ekspedisiModel;
    protected $usersModel;
    protected $ordersModel;
    protected $paymentMethodModel;
    protected $paymentDetailModel;
    protected $session;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->productModel = new ProductsModel();
        $this->ekspedisiModel = new EkspedisiModel();
        $this->usersModel = new UsersModel();
        $this->ordersModel = new OrdersModel();
        $this->paymentMethodModel = new PaymentMethodModel();
        $this->paymentDetailModel = new PaymentDetailModel();
        $this->session = session();
    }

    public function index()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = $this->session->get('id');
        
        // Mengambil item keranjang dengan detail produk
        $cartItems = $this->cartModel->getCartItems($userId);
        
        // Menghitung subtotal
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $data = [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'paymentMethods' => $this->paymentMethodModel->findAll(),
            'ekspedisi' => $this->ekspedisiModel->findAll()
        ];

        return view('homepages/cart', $data);
    }

    private function getUserAddress($userId)
    {
        $user = $this->usersModel->find($userId);
        return $user ? $user['alamat'] : '';
    }

    public function add()
    {
        if (!$this->session->get('logged_in')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ]);
        }

        $productId = $this->request->getPost('product_id');
        $quantity = $this->request->getPost('quantity') ?? 1;
        $userId = $this->session->get('id');

        // Cek stok produk
        $product = $this->productModel->find($productId);
        if (!$product || $product['stock'] < $quantity) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Stok tidak mencukupi'
            ]);
        }

        // Cek apakah produk sudah ada di keranjang
        $existingItem = $this->cartModel->where([
            'user_id' => $userId,
            'product_id' => $productId
        ])->first();

        if ($existingItem) {
            // Update quantity jika sudah ada
            $newQuantity = $existingItem['quantity'] + $quantity;
            if ($newQuantity > $product['stock']) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi'
                ]);
            }

            $this->cartModel->update($existingItem['id'], [
                'quantity' => $newQuantity
            ]);
        } else {
            // Tambah item baru ke keranjang
            $this->cartModel->insert([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }

        // Hitung jumlah item di keranjang
        $cartCount = $this->cartModel->where('user_id', $userId)->countAllResults();

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'cartCount' => $cartCount
        ]);
    }

    public function update($cartId)
    {
        if (!$this->session->get('logged_in')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ]);
        }

        $userId = $this->session->get('id');
        $action = $this->request->getPost('action');
        
        // Ambil item cart berdasarkan cart_id
        $cartItem = $this->cartModel->where([
            'id' => $cartId,
            'user_id' => $userId
        ])->first();

        if (!$cartItem) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Item tidak ditemukan'
            ]);
        }

        // Update quantity
        $newQuantity = $action === 'increase' ? $cartItem['quantity'] + 1 : $cartItem['quantity'] - 1;

        if ($newQuantity < 1) {
            // Hapus item jika quantity 0
            $this->cartModel->delete($cartId);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Item dihapus dari keranjang'
            ]);
        }

        // Update quantity
        $this->cartModel->update($cartId, ['quantity' => $newQuantity]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Keranjang berhasil diupdate'
        ]);
    }

    public function remove($cartId)
    {
        if (!$this->session->get('logged_in')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ]);
        }

        $userId = $this->session->get('id');

        // Hapus item berdasarkan cart_id dan user_id
        $result = $this->cartModel->where([
            'id' => $cartId,
            'user_id' => $userId
        ])->delete();

        if ($result) {
            $cartCount = $this->cartModel->where('user_id', $userId)->countAllResults();
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Item berhasil dihapus',
                'cartCount' => $cartCount
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal menghapus item'
        ]);
    }

    public function clear()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = $this->session->get('id');
        $this->cartModel->where('user_id', $userId)->delete();

        return redirect()->to('/cart')->with('message', 'Keranjang berhasil dikosongkan');
    }

    public function checkout()
    {
        $db = \Config\Database::connect();
        $db->transStart();

        // Menggunakan id dari session yang benar
        $userId = $this->session->get('id');

        // Debug: Log input data
        log_message('debug', 'Checkout Data: ' . json_encode([
            'user_id' => $userId,
            'payment_method' => $this->request->getPost('payment_method_id'),
            'ekspedisi' => $this->request->getPost('ekspedisi_id'),
            'total' => $this->request->getPost('total_amount')
        ]));

        $cartItems = $this->cartModel->getCartItems($userId);
        
        if (empty($cartItems)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Keranjang kosong'
            ]);
        }

        $paymentMethodId = $this->request->getPost('payment_method_id');
        $ekspedisiId = $this->request->getPost('ekspedisi_id');
        $totalAmount = $this->cartModel->getCartTotal($userId);

        // Debug: Log processed data
        log_message('debug', 'Processed Data: ' . json_encode([
            'cartItems' => $cartItems,
            'totalAmount' => $totalAmount
        ]));

        if (!$paymentMethodId || !$ekspedisiId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data pembayaran tidak lengkap'
            ]);
        }

        // Buat order baru dengan product_id dan quantity
        $orderData = [
            'user_id' => $userId,
            'product_id' => $cartItems[0]['product_id'],
            'quantity' => $cartItems[0]['quantity'],
            'total_price' => $totalAmount,
            'payment_method_id' => $paymentMethodId,
            'ekspedisi_id' => $ekspedisiId,
            'status' => 'dibayar'
        ];

        // Debug: Log order data
        log_message('debug', 'Order Data: ' . json_encode($orderData));

        $orderId = $this->ordersModel->insert($orderData);
        
        if (!$orderId) {
            $db->transRollback();
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal membuat pesanan'
            ]);
        }

        // Update stok produk
        foreach ($cartItems as $item) {
            $product = $this->productModel->find($item['product_id']);
            $newStock = $product['stock'] - $item['quantity'];
            
            if ($newStock < 0) {
                $db->transRollback();
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Stok produk ' . $item['name_products'] . ' tidak mencukupi'
                ]);
            }

            if (!$this->productModel->update($item['product_id'], ['stock' => $newStock])) {
                $db->transRollback();
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal memperbarui stok produk'
                ]);
            }
        }

        // Kosongkan keranjang
        if (!$this->cartModel->where('user_id', $userId)->delete()) {
            $db->transRollback();
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal mengosongkan keranjang'
            ]);
        }

        // Setelah order dibuat, buat juga payment detail
        if ($orderId) {
            $paymentData = [
                'order_id' => $orderId,
                'payment_method_id' => $paymentMethodId,
                'amount' => $totalAmount,
                'payment_status' => 'success',
                'transaction_id' => 'TRX-' . date('YmdHis') . rand(1000, 9999),
                'payment_date' => date('Y-m-d H:i:s')
            ];
            
            $this->paymentDetailModel->insert($paymentData);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memproses pesanan'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Pesanan berhasil dibuat',
            'order_id' => $orderId,
            'redirect' => base_url('checkout')
        ]);
    }
}