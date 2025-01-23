<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrdersModel;
use App\Models\PaymentDetailModel;
use App\Models\CartModel;
use App\Models\ProductsModel;
use App\Models\EkspedisiModel;
use App\Models\PaymentMethodModel;
use App\Models\UsersModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class CheckoutController extends BaseController
{
    protected $ordersModel;
    protected $paymentDetailModel;
    protected $cartModel;
    protected $productsModel;
    protected $ekspedisiModel;
    protected $paymentMethodModel;
    protected $usersModel;
    protected $session;

    public function __construct()
    {
        $this->ordersModel = new OrdersModel();
        $this->paymentDetailModel = new PaymentDetailModel();
        $this->cartModel = new CartModel();
        $this->productsModel = new ProductsModel();
        $this->ekspedisiModel = new EkspedisiModel();
        $this->paymentMethodModel = new PaymentMethodModel();
        $this->usersModel = new UsersModel();
        $this->session = session();
    }

    public function index()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = $this->session->get('id');
        $data['orders'] = $this->ordersModel->getOrderHistory($userId);
        $data['empty_message'] = [
            'heading' => 'Belum ada pesanan',
            'message' => 'Mulai belanja dan nikmati layanan kami',
            'button_text' => 'Mulai Belanja',
            'button_link' => base_url('shop')
        ];
        
        return view('checkout/order_list', $data);
    }

    public function process()
    {
        $userId = session()->get('id');
        if (!$userId) {
            return redirect()->to('/login');
        }

        $cartItems = $this->cartModel->getCartItems($userId);
        if (empty($cartItems)) {
            return redirect()->to('/cart')->with('error', 'Keranjang belanja kosong');
        }

        $paymentMethodId = $this->request->getPost('payment_method');
        $ekspedisiId = $this->request->getPost('ekspedisi');

        if (!$paymentMethodId || !$ekspedisiId) {
            return redirect()->back()->with('error', 'Mohon lengkapi semua data');
        }

        $ekspedisi = $this->ekspedisiModel->find($ekspedisiId);
        $user = $this->usersModel->find($userId);

        foreach ($cartItems as $item) {
            $product = $this->productsModel->find($item['product_id']);
            
            if ($product['stock'] < $item['quantity']) {
                return redirect()->back()->with('error', "Stok {$product['name_products']} tidak mencukupi");
            }

            // Data order
            $orderData = [
                'order_id' => 'INV-' . time() . rand(1000, 9999),
                'user_id' => $userId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'total_price' => ($item['price'] * $item['quantity']) + $ekspedisi['harga_ongkir'],
                'status' => ($paymentMethodId == 3) ? 'Dikirim' : 'Dibayar',
                'payment_method_id' => $paymentMethodId,
                'ekspedisi_id' => $ekspedisiId
            ];

            $orderId = $this->ordersModel->insert($orderData);

            // Data pembayaran
            $paymentData = [
                'order_id' => $orderId,
                'transaction_id' => 'TRX-' . time() . rand(1000, 9999),
                'payment_method_id' => $paymentMethodId,
                'payment_status' => 'Berhasil',
                'amount_paid' => ($item['price'] * $item['quantity']) + $ekspedisi['harga_ongkir'],
                'payment_date' => date('Y-m-d H:i:s')
            ];

            $this->paymentDetailModel->insert($paymentData);

            // Update stok
            $newStock = $product['stock'] - $item['quantity'];
            $this->productsModel->update($item['product_id'], ['stock' => $newStock]);
        }

        // Hapus cart
        $this->cartModel->where('user_id', $userId)->delete();

        return redirect()->to('/checkout/success')->with('success', 'Pesanan berhasil diproses!');
    }

    public function invoice($orderId)
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data['order'] = $this->ordersModel->getOrderDetail($orderId);
        
        if (!$data['order'] || $data['order']['user_id'] != $this->session->get('id')) {
            return redirect()->to('/checkout/history');
        }

        return view('checkout/invoice', $data);
    }

    public function success()
    {
        return view('checkout/success');
    }

    public function generateInvoicePdf($orderId)
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data['order'] = $this->ordersModel->getOrderDetail($orderId);
        
        if (!$data['order'] || $data['order']['user_id'] != $this->session->get('id')) {
            return redirect()->to('/checkout/history');
        }

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        
        $dompdf = new Dompdf($options);
        $html = view('checkout/invoice_pdf', $data);
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        $dompdf->stream('Invoice-'.$data['order']['order_id'].'.pdf', [
            "Attachment" => false
        ]);
    }

    public function orderHistory()
    {
        $userId = session()->get('id');
        if (!$userId) {
            return redirect()->to('/login');
        }

        $orders = $this->ordersModel->getOrdersByUser($userId);

        return view('checkout/history', [
            'orders' => $orders,
            'title' => 'Riwayat Pesanan'
        ]);
    }

    public function tracking($orderId)
    {
        
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data['order'] = $this->ordersModel->getOrderDetail($orderId);
        
        if (!$data['order'] || $data['order']['user_id'] != $this->session->get('id')) {
            return redirect()->to('/checkout/history');
        }

        return view('checkout/tracking', $data);
    }

    public function history()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = $this->session->get('id');
        $data['orders'] = $this->ordersModel->getOrderHistory($userId);
        
        return view('checkout/history', $data);
    }

    public function checkStatus($orderId)
    {
        $order = $this->ordersModel->find($orderId);
        return $this->response->setJSON(['status' => $order['status']]);
    }

    // Update method untuk tracking
    public function updateOrderStatus($orderId, $newStatus)
    {
        $order = $this->ordersModel->find($orderId);
        if (!$order) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Order tidak ditemukan'
            ]);
        }

        // Logic status berdasarkan metode pembayaran
        $validStatus = true;
        if ($order['payment_method'] == 'cod') {
            // Untuk COD: Dikirim -> Selesai
            $validStatus = $newStatus == 'Selesai' && $order['status'] == 'Dikirim';
        } else {
            // Untuk non-COD: Dibayar -> Dikirim -> Selesai
            $validStatus = match($newStatus) {
                'Dikirim' => $order['status'] == 'Dibayar',
                'Selesai' => $order['status'] == 'Dikirim',
                default => false
            };
        }

        if (!$validStatus) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Status tidak valid'
            ]);
        }

        // Update status
        $this->ordersModel->update($orderId, ['status' => $newStatus]);
        
        // Add tracking history
        $description = match($newStatus) {
            'Dikirim' => 'Pesanan dalam proses pengiriman',
            'Selesai' => 'Pesanan telah selesai',
            default => 'Status pesanan diperbarui'
        };
        
        

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Status berhasil diperbarui'
        ]);
    }

    public function updatePaymentStatus($orderId)
    {
        $result = $this->paymentDetailModel->updatePaymentStatus($orderId, 'Berhasil');
        
        return $this->response->setJSON([
            'success' => $result,
            'message' => $result ? 'Status pembayaran berhasil diperbarui' : 'Gagal memperbarui status pembayaran'
        ]);
    }
} 