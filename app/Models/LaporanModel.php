<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = ['id'];
    protected $allowedFields = ['tilte', 'description', 'start-date', 'end-date', 'stock', 'total-orders', 'total-income', 'created_at', 'updated_at'];
    protected $beforeInsert = ['GenerateKodeUnik'];

    protected function GenerateKodeUnik(array $data)
    {
        $data['data']['kode_produk'] = 'PRD-' . strtoupper(bin2hex(random_bytes(3))); 
        return $data;
    }
}



