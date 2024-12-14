<?php

namespace App\Controllers;
use App\Controllers\BaseController;

    class SectionDashboard extends BaseController{
    
        public function orderdetail(){
            return view('admin/detailorder');
        }
    
        public function managecontent(){
            return view('admin/kelolakonten');
        }
        
        public function managecart(){
            return view('admin/keranjang');
        }

        public function manageproduct(){
            return view('admin/products/products_views');
        }

        public function managetransaction(){
            return view('admin/transaksi');
        }

        public function reports(){
            return view('admin/laporan');
        }
    }
    

?>