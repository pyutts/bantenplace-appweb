<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

    // Landing Pages Bantenplace
    $routes->get('/', 'Home::index'); 

    // Auth Login dan Daftar
    $routes->get('/login', 'Auth::login', ['filter' => 'noauth']);
    $routes->post('/auth/attemptLogin', 'Auth::attemptLogin', ['filter' => 'noauth']);
    $routes->get('/register', 'Auth::register', ['filter' => 'noauth']);
    $routes->post('/auth/attemptRegister', 'Auth::attemptRegister', ['filter' => 'noauth']);
    $routes->get('/logout', 'Auth::logout');

    $routes->group('dashboard', ['filter' => 'role:Admin','auth'], function ($routes) {
        // Isi Konten Adminnya 
        $routes->get('/', 'Admin::dashboard');
        
        // Daftar Users Dashboard
        $routes->get('users', 'UserDashboard::index'); 
        $routes->post('users/addProses', 'UserDashboard::addProses'); 
        $routes->get('users/addProses', 'UserDashboard::addProses'); 
        $routes->post('users/save', 'UserDashboard::saveData'); 
        $routes->get('users/edit/(:segment)', 'UserDashboard::edit/$1'); 
        $routes->post('users/update', 'UserDashboard::update');
        $routes->delete('users/delete/(:num)', 'UserDashboard::delete/$1');
        
        // Daftar Products Dashboard
        $routes->get('products', 'ProductsDashboard::index'); 
        $routes->get('products/add', 'ProductsDashboard::add'); 
        $routes->post('products/saveData', 'ProductsDashboard::saveData'); 
        $routes->get('products/edit/(:num)', 'ProductsDashboard::edit/$1'); 
        $routes->post('products/update', 'ProductsDashboard::update');
        $routes->delete('products/delete/(:num)', 'ProductsDashboard::delete/$1');
        
        // Daftar Kategori Dashboard
        $routes->get('categories', 'CategoryDashboard::index'); 
        $routes->get('categories/add', 'CategoryDashboard::add'); 
        $routes->post('categories/saveData', 'CategoryDashboard::saveData'); 
        $routes->get('categories/edit/(:num)', 'CategoryDashboard::edit/$1'); 
        $routes->post('categories/update', 'CategoryDashboard::update');
        $routes->delete('categories/delete/(:num)', 'CategoryDashboard::delete/$1');
        
        // Daftar Ekspedisi Dashboard
        $routes->get('ekspedisi', 'EkspedisiDashboard::index'); 
        $routes->get('ekspedisi/add', 'EkspedisiDashboard::add'); 
        $routes->post('ekspedisi/saveData', 'EkspedisiDashboard::saveData'); 
        $routes->get('ekspedisi/edit/(:num)', 'EkspedisiDashboard::edit/$1'); 
        $routes->post('ekspedisi/update', 'EkspedisiDashboard::update');
        $routes->delete('ekspedisi/delete/(:num)', 'EkspedisiDashboard::delete/$1');

        // Orders routes
        $routes->get('orders', 'OrdersDashboard::index');

        // Payments routes
        $routes->get('payments', 'PaymentsController::index');
        $routes->get('payments/view/(:segment)', 'PaymentsController::view/$1');
        $routes->get('payments/report', 'PaymentsController::generateReport');

        // Report routes
        $routes->get('reports', 'ReportsController::index');
        $routes->post('reports/generate', 'ReportsController::generate');
        $routes->get('reports/exportPdf/(:num)/(:num)', 'ReportsController::exportPdf/$1/$2');
    
    });
 
    $routes->group('', ['filter' => 'role:User'], function ($routes) {
        // Proses Beranda
        $routes->get('/homes', 'SectionHome::home');
        // Proses About
        $routes->get('/about', 'SectionHome::about');
        // Proses Shop
        $routes->get('shop', 'ShopController::index');
        // Proses Keranjang
        $routes->group('cart', ['namespace' => 'App\Controllers'], function($routes) {
            $routes->get('/', 'CartController::index');
            $routes->post('add', 'CartController::add');
            $routes->post('update/(:num)', 'CartController::update/$1');
            $routes->post('remove/(:num)', 'CartController::remove/$1');
            $routes->post('checkout', 'CartController::checkout');
        });
        // Proses Akun
        $routes->group('myaccounts', function($routes) {
            $routes->get('/', 'AccountController::myaccounts');
            $routes->get('edit', 'AccountController::edit');
            $routes->post('update', 'AccountController::update');
        });
        // Proses Checkout
        $routes->group('checkout', ['filter' => 'auth'], function($routes) {
            $routes->get('/', 'CheckoutController::index');
            $routes->get('history', 'CheckoutController::history');
            $routes->get('tracking/(:num)', 'CheckoutController::tracking/$1');
            $routes->get('checkStatus/(:num)', 'CheckoutController::checkStatus/$1');
            $routes->get('invoice/(:num)', 'CheckoutController::invoice/$1');
            $routes->get('generateInvoicePdf/(:num)', 'CheckoutController::generateInvoicePdf/$1');
            $routes->get('orders', 'CheckoutController::orderList');
        });
      
    });

    

 
 
 