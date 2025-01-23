<?php

namespace App\Controllers;

use App\Models\OrdersModel;
use App\Models\UsersModel;
use App\Models\ProductsModel;

class Admin extends BaseController
{
    protected $ordersModel;
    protected $usersModel;
    protected $productsModel;

    public function __construct()
    {
        $this->ordersModel = new OrdersModel();
        $this->usersModel = new UsersModel();
        $this->productsModel = new ProductsModel();
    }

    public function dashboard()
    {
        // Mengambil statistik untuk dashboard
        $data = [
            'title' => 'Dashboard',
            'total_orders' => $this->ordersModel->countAllResults(),
            'total_users' => $this->usersModel->countAllResults(),
            'total_products' => $this->productsModel->countAllResults(),
            'recent_orders' => $this->ordersModel->select('orders.*, orders.total_price as total_amount, orders.created_at as order_date')
                                               ->orderBy('id', 'DESC')
                                               ->limit(5)
                                               ->find(),
            'low_stock_products' => $this->productsModel->where('stock <=', 10)
                                                      ->findAll(),
            // Menghitung total pendapatan bulan ini menggunakan created_at
            'monthly_income' => $this->ordersModel->select('SUM(total_price) as total')
                                               ->where('MONTH(created_at)', date('m'))
                                               ->where('YEAR(created_at)', date('Y'))
                                               ->get()
                                               ->getRow()
                                               ->total ?? 0
        ];

        return view('admin/dashboard', $data);
    }

    // Fungsi untuk mendapatkan data grafik pendapatan
    public function getIncomeChart()
    {
        $monthlyData = $this->ordersModel->getMonthlyIncomeData();
        return $this->response->setJSON($monthlyData);
    }

    // Fungsi untuk mendapatkan data statistik real-time
    public function getStatistics()
    {
        $stats = [
            'today_orders' => $this->ordersModel->getTodayOrders(),
            'today_income' => $this->ordersModel->getTodayIncome(),
            'pending_orders' => $this->ordersModel->where('status', 'pending')->countAllResults(),
        ];
        
        return $this->response->setJSON($stats);
    }
}

