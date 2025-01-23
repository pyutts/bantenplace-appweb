<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentDetailModel extends Model
{
    protected $table = 'payment_details';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'order_id', 'transaction_id', 'payment_method_id',
        'payment_status', 'amount_paid', 'payment_date',
        'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;

    protected $beforeInsert = ['generateTransactionId'];

    protected function generateTransactionId(array $data)
    {
        $date = date('Ymd');
        $randomNumber = mt_rand(1000, 9999);
        $data['data']['transaction_id'] = 'TRX-' . $date . '-' . $randomNumber;
        return $data;
    }

    public function createPayment($orderId, $amount, $paymentMethodId)
    {
        return $this->insert([
            'order_id' => $orderId,
            'payment_method_id' => $paymentMethodId,
            'amount_paid' => $amount,
            'payment_status' => 'Pending',
            'payment_date' => date('Y-m-d H:i:s')
        ]);
    }

    public function updatePaymentStatus($orderId, $status)
    {
        $payment = $this->where('order_id', $orderId)->first();
        if ($payment) {
            $this->update($payment['id'], [
                'payment_status' => $status,
                'payment_date' => date('Y-m-d H:i:s')
            ]);

            if ($status === 'Berhasil') {
                $orderModel = new OrdersModel();
                $orderModel->updateStatus($orderId, 'Dibayar');
            }

            return true;
        }
        return false;
    }

    public function getPaymentByOrderId($orderId)
    {
        return $this->where('order_id', $orderId)->first();
    }
} 