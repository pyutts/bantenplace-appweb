<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['uid','category', 'name', 'description', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getCategories()
    {
        return $this->findAll();
    }
}