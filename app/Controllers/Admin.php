<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function dashboard()
    {
        $data = ['title' => 'Dashboard'];
        return view('admin/dashboard', $data);
    }
}

