<?php

namespace App\Controllers;
use App\Controllers\BaseController;

    class SectionHome extends BaseController{
        public function home(){
            return view('homepages/home_views');
        }
    
        public function about(){
            return view('homepages/about');
        }
    }
    

?>