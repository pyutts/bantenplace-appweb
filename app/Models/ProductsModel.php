<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name_products', 'gambar_products', 'description', 'price', 'stock', 'kode_products', 'category_id', 'created_at', 'updated_at'];

    protected $beforeInsert = ['generateKodeUnik'];

    protected function generateKodeUnik(array $data)
    {
        $data['data']['kode_products'] = 'PRD-' . strtoupper(bin2hex(random_bytes(3))); 
        return $data;
    }

    public function getProducts($categoryId = null, $sortOrder = 'asc')
    {
        if ($categoryId) {
            $this->where('category_id', $categoryId);
        }
        return $this->orderBy('price', $sortOrder)->findAll();
    }
}