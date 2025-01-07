<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrdersModel;
use App\Models\EkspedisiModel;
use App\Models\PaymentsModel;

class OrdersDashboard extends BaseController
{
    protected $orders;
    protected $ekspedisi;
    protected $payments;

    public function __construct()
    {
        $this->orders = new OrdersModel();
        $this->ekspedisi = new EkspedisiModel();
        $this->payments = new PaymentsModel();
    }

    public function index()
    {
        $orders = $this->orders->select('orders.*, ekspedisi.nama_ekspedisi, payments.transaction_id, payments.amount as payment_amount, payments.payment_date')
                               ->join('ekspedisi', 'orders.ekspedisi_id = ekspedisi.id', 'left')
                               ->join('payment_details as payments', 'orders.id = payments.order_id', 'left')
                               ->findAll();

        return view('admin/orders/orders_views', ['orders' => $orders]);
    }

    public function edit($id)
    {
        $order = $this->orders->find($id);
        $ekspedisi = $this->ekspedisi->findAll();

        if (!$order) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Order tidak ditemukan']);
        }

        return $this->response->setJSON(['status' => 'success', 'data' => $order, 'ekspedisi' => $ekspedisi]);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $order = $this->orders->find($id);

        if (!$order) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Order tidak ditemukan']);
        }

        $validation = \Config\Services::validation();
        $rules = [
            'status'       => 'required',
            'ekspedisi_id' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        $data = [
            'status'       => $this->request->getPost('status'),
            'ekspedisi_id' => $this->request->getPost('ekspedisi_id')
        ];

        $this->orders->update($id, $data);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Order berhasil diperbarui.']);
    }
}