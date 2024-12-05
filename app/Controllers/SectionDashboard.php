<?php

namespace App\Controllers;
use App\Controllers\BaseController;

    class SectionDashboard extends BaseController{
        public function user(){
            return view('admin/user');
        }
    
        public function orderdetail(){
            return view('admin/detailorder');
        }
    
        public function category(){
            return view('admin/kategori');
        }
    
        public function managecontent(){
            return view('admin/kelolakonten');
        }
        
        public function managecart(){
            return view('admin/keranjang');
        }

        public function manageproduct(){
            return view('admin/produk');
        }

        public function managetransaction(){
            return view('admin/transaksi');
        }

        public function reports(){
            return view('admin/laporan');
        }
    }
    

?>