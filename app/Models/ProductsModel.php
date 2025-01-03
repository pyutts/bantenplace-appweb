<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = ['id'];
    protected $allowedFields = ['name', 'gambar_produk', 'description', 'price', 'stock', 'category_id', 'kode_produk', 'created_at', 'updated_at'];

    protected $beforeInsert = ['GenerateKodeUnik'];

    protected function GenerateKodeUnik(array $data)
    {
        $data['data']['kode_produk'] = 'PRD-' . strtoupper(bin2hex(random_bytes(3))); 
        return $data;
    }
}

