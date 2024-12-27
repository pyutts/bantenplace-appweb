<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'name_products', 'description', 'price', 'stock', 
        'category_id','profil_gambar', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;

}