<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaymentsModel;
use App\Models\OrdersModel;

class PaymentsController extends BaseController
{
    protected $payments;
    protected $orders;

    public function __construct()
    {
        $this->payments = new PaymentsModel();
        $this->orders = new OrdersModel();
    }

    public function index()
    {
        $payments = $this->payments->select('payment_details.*, orders.order_id')
                                   ->join('orders', 'payment_details.order_id = orders.id', 'left')
                                   ->findAll();

        return view('admin/payments/payments_views', ['payments' => $payments]);
    }

    public function view($id)
    {
        $payment = $this->payments->select('payment_details.*, orders.order_id')
                                  ->join('orders', 'payment_details.order_id = orders.id', 'left')
                                  ->where('payment_details.id', $id)
                                  ->first();

        if (!$payment) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Payment tidak ditemukan']);
        }

        return view('admin/payments/details_payments', ['payment' => $payment]);
    }
}