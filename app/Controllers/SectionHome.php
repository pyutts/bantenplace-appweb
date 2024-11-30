<?php

namespace App\Controllers;
use App\Controllers\BaseController;

    class SectionHome extends BaseController{
        public function shop(){
            return view('homepages/shop');
        }
    
        public function about(){
            return view('homepages/about');
        }
    

        public function cart(){
            return view('homepages/cart');
        }
    

        public function testimoni(){
            return view('homepages/testimoni');
        }
    }
    

?>