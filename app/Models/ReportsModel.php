<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportsModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title', 'description', 'start_date', 'end_date', 'total_orders', 'total_income', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;

    public function getMonthlyReport($month, $year)
    {
        $startDate = "$year-$month-01";
        $endDate = date("Y-m-t", strtotime($startDate));

        $query = $this->db->query("
            SELECT 
                COUNT(*) as total_orders,
                SUM(total_price) as total_income
            FROM orders
            WHERE created_at BETWEEN '$startDate' AND '$endDate'
        ");

        return $query->getRowArray();
    }

    public function getMostPurchasedProducts($month, $year)
    {
        $startDate = "$year-$month-01";
        $endDate = date("Y-m-t", strtotime($startDate));

        $query = $this->db->query("
            SELECT 
                p.name_products,
                SUM(o.quantity) as total_quantity,
                SUM(o.quantity * p.price) as total_income
            FROM orders o
            JOIN products p ON o.product_id = p.id
            WHERE o.created_at BETWEEN '$startDate' AND '$endDate'
            GROUP BY o.product_id, p.name_products
            ORDER BY total_quantity DESC
            LIMIT 10
        ");

        return $query->getResultArray();
    }

    public function getProductsPurchasedThisMonth($month, $year)
    {
        $startDate = "$year-$month-01";
        $endDate = date("Y-m-t", strtotime($startDate));

        $query = $this->db->query("
            SELECT 
                p.name_products,
                SUM(o.quantity) as total_quantity,
                SUM(o.quantity * p.price) as total_income
            FROM orders o
            JOIN products p ON o.product_id = p.id
            WHERE o.created_at BETWEEN '$startDate' AND '$endDate'
            GROUP BY o.product_id, p.name_products
        ");

        return $query->getResultArray();
    }
}