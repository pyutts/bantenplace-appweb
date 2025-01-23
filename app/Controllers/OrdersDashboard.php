<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrdersModel;
use App\Models\EkspedisiModel;

class OrdersDashboard extends BaseController
{
    protected $orders;
    protected $ekspedisi;

    public function __construct()
    {
        $this->orders = new OrdersModel();
        $this->ekspedisi = new EkspedisiModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('orders');
        $builder->select('
            orders.order_id,
            users.nama as customer_name,
            products.name_products as product_name,
            categories.name as category_name,
            orders.status,
            payment_methods.name as payment_method_name,
            ekspedisi.nama_ekspedisi
        ');
        $builder->join('users', 'orders.user_id = users.id', 'left');
        $builder->join('products', 'orders.product_id = products.id', 'left');
        $builder->join('categories', 'products.category_id = categories.id', 'left');
        $builder->join('payment_methods', 'orders.payment_method_id = payment_methods.id', 'left');
        $builder->join('ekspedisi', 'orders.ekspedisi_id = ekspedisi.id', 'left');
        $query = $builder->get();
        $orders = $query->getResultArray();

        return view('admin/orders/orders_views', [
            'orders' => $orders
        ]);
    }

    
}