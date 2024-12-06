<?php

namespace App\Controllers;

class Homepages extends BaseController
{
    public function index(): string
    {
        return view('homepages/home');
    }
}
