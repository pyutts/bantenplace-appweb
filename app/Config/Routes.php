<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->get('/', 'Home::index'); 


 $routes->get('/login', 'Auth::login', ['filter' => 'noauth']);
 $routes->post('/auth/attemptLogin', 'Auth::attemptLogin', ['filter' => 'noauth']);
 $routes->get('/register', 'Auth::register', ['filter' => 'noauth']);
 $routes->post('/auth/attemptRegister', 'Auth::attemptRegister', ['filter' => 'noauth']);
 $routes->get('/logout', 'Auth::logout');

 $routes->group('dashboard', ['filter' => 'role:Admin','auth'], function ($routes) {
     $routes->get('/', 'Admin::dashboard');
    // Daftar Users Dashboard
     
    $routes->get('users', 'UserDashboard::user'); // Menampilkan daftar pengguna
    $routes->get('users/add', 'UserDashboard::createUser'); // Form tambah pengguna
    $routes->post('users/addProses', 'UserDashboard::addProsesUser');

    $routes->get('users/edit/(:num)', 'UserDashboard::edit/$1'); // Form edit pengguna dengan ID
    $routes->post('users/update/(:num)', 'UserDashboard::update/$1'); // Memperbarui pengguna berdasarkan ID
    $routes->get('users/delete/(:num)', 'UserDashboard::delete/$1'); // Menghapus pengguna berdasarkan ID

     $routes->post('admin/users/addUsers', 'Admin/UsersDashboard::addUsers');
     $routes->get('AddUsers', 'UserDashboard::addUsers');
     $routes->get('orderdetail', 'SectionDashboard::orderdetail');
     $routes->get('category', 'SectionDashboard::category');
     $routes->get('managecontent', 'SectionDashboard::managecontent');
     $routes->get('managecart', 'SectionDashboard::managecart');
     $routes->get('manageproduct', 'SectionDashboard::manageproduct');
     $routes->get('managetransaction', 'SectionDashboard::managetransaction');
     $routes->get('reports', 'SectionDashboard::reports');
 });
 
 $routes->group('', ['filter' => 'role:User'], function ($routes) {
     $routes->get('/home/user', 'Homepages::index');
     $routes->get('/about/user', 'SectionHome::about');
     $routes->get('/shop/user', 'SectionHome::shop');
     $routes->get('/cart/user', 'SectionHome::cart');
     $routes->get('/testimoni/user', 'SectionHome::testimoni');
 });

 
 
 