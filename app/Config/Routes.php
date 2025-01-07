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
        $routes->get('users/edit/(:num)', 'UserDashboard::edit/$1'); 
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
        $routes->get('orders/edit/(:num)', 'OrdersDashboard::edit/$1');
        $routes->post('orders/update', 'OrdersDashboard::update');

        // Payments routes
        $routes->get('payments', 'PaymentsController::index');
        $routes->get('payments/view/(:num)', 'PaymentsController::view/$1');
    
        // Section Lain
        $routes->get('orderdetail', 'SectionDashboard::orderdetail');
        $routes->get('managecontent', 'SectionDashboard::managecontent');
        $routes->get('managecart', 'SectionDashboard::managecart');
        $routes->get('managetransaction', 'SectionDashboard::managetransaction');
        $routes->get('reports', 'SectionDashboard::reports');
    });
 
 $routes->group('', ['filter' => 'role:User'], function ($routes) {
     $routes->get('/home/user', 'Homepages::index');
     $routes->get('/about/user', 'SectionHome::about');
    
     $routes->get('shop', 'ShopController::index');
     

    $routes->get('cart', 'CartController::index');
    $routes->get('cart/updateQuantity/(:num)/(:num)', 'CartController::updateQuantity/$1/$2');
    $routes->get('cart/removeItem/(:num)', 'CartController::removeItem/$1');

     $routes->get('/testimoni/user', 'SectionHome::testimoni');
 });

 
 
 