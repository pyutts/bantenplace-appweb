<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentsModel extends Model
{
    protected $table            = 'payment_details';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['order_id', 'transaction_id', 'payment_method', 'payment_status', 'amount_paid', 'payment_date', 'created_at', 'updated_at'];

    protected $beforeInsert = ['generateUniqueTransactionId'];

    protected function generateUniqueTransactionId(array $data)
    {
        $data['data']['transaction_id'] = $this->generateUniqueCode();
        return $data;
    }

    private function generateUniqueCode()
    {
        $date = date('Ymd');
        $randomNumber = mt_rand(1000, 9999);
        return 'TRX-' . $date . '-' . $randomNumber;
    }
}