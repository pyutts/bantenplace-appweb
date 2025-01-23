<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaymentsModel;
use App\Models\OrdersModel;
use Config\Database;
use Dompdf\Dompdf;
use Dompdf\Options;

class PaymentsController extends BaseController
{
    protected $payments;
    protected $orders;
    protected $db;

    public function __construct()
    {
        $this->payments = new PaymentsModel();
        $this->orders = new OrdersModel();
        $this->db = Database::connect();
    }

    public function index()
    {
        $payments = $this->orders->select('orders.order_id, payment_details.transaction_id, orders.status AS payment_status, payment_details.amount_paid, payment_details.payment_date, orders.total_price')
                                 ->join('payment_details', 'payment_details.order_id = orders.id')
                                 ->findAll();

        return view('admin/payments/payments_views', ['payments' => $payments]);
    }

    public function view($orderId)
    {
        $payment = $this->orders->select('orders.order_id, payment_details.transaction_id, orders.status AS payment_status, payment_details.amount_paid, payment_details.payment_date, orders.total_price')
                                ->join('payment_details', 'payment_details.order_id = orders.id')
                                ->where('orders.order_id', $orderId)
                                ->first();

        if (!$payment) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Payment tidak ditemukan']);
        }

        return view('admin/payments/details_payments', ['payment' => $payment]);
    }

    public function generateReport()
    {
        $payments = $this->orders->select('orders.order_id, payment_details.transaction_id, orders.status AS payment_status, payment_details.amount_paid, payment_details.payment_date, orders.total_price')
                                 ->join('payment_details', 'payment_details.order_id = orders.id')
                                 ->findAll();

        $html = view('admin/payments/report_template', ['payments' => $payments]);

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("payments_report.pdf", ["Attachment" => false]);
    }
}