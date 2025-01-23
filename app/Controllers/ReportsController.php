<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReportsModel;
use Dompdf\Dompdf;

class ReportsController extends BaseController
{
    protected $reports;

    public function __construct()
    {
        $this->reports = new ReportsModel();
    }

    public function index()
    {
        return view('admin/reports/reports_views');
    }

    public function generate()
    {
        $month = $this->request->getPost('month');
        $year = $this->request->getPost('year');

        $monthlyReport = $this->reports->getMonthlyReport($month, $year);
        $mostPurchasedProducts = $this->reports->getMostPurchasedProducts($month, $year);
        $productsPurchasedThisMonth = $this->reports->getProductsPurchasedThisMonth($month, $year);

        // Pastikan data memiliki nilai default jika kosong
        $monthlyReport = [
            'total_orders' => $monthlyReport['total_orders'] ?? 0,
            'total_income' => $monthlyReport['total_income'] ?? 0
        ];

        // Pastikan setiap produk memiliki total_income
        foreach ($mostPurchasedProducts as &$product) {
            $product['total_income'] = $product['total_income'] ?? 0;
        }

        foreach ($productsPurchasedThisMonth as &$product) {
            $product['total_income'] = $product['total_income'] ?? 0;
        }

        $data = [
            'month' => $month,
            'year' => $year,
            'monthlyReport' => $monthlyReport,
            'mostPurchasedProducts' => $mostPurchasedProducts,
            'productsPurchasedThisMonth' => $productsPurchasedThisMonth
        ];

        return view('admin/reports/report_details', $data);
    }

    public function exportPdf($month, $year)
    {
        $monthlyReport = $this->reports->getMonthlyReport($month, $year);
        $mostPurchasedProducts = $this->reports->getMostPurchasedProducts($month, $year);

        $html = view('admin/reports/report_pdf', [
            'month' => $month,
            'year' => $year,
            'monthlyReport' => $monthlyReport,
            'mostPurchasedProducts' => $mostPurchasedProducts
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("report_{$month}_{$year}.pdf", ["Attachment" => false]);
    }
}