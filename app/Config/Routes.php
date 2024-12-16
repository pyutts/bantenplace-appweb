<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  Landing Pages Bantenplace
 $routes->get('/', 'Home::index'); 

// Auth Login dan Daftar
 $routes->get('/login', 'Auth::login', ['filter' => 'noauth']);
 $routes->post('/auth/attemptLogin', 'Auth::attemptLogin', ['filter' => 'noauth']);
 $routes->get('/register', 'Auth::register', ['filter' => 'noauth']);
 $routes->post('/auth/attemptRegister', 'Auth::attemptRegister', ['filter' => 'noauth']);
 $routes->get('/logout', 'Auth::logout');

 $routes->group('dashboard', ['filter' => 'role:Admin','auth'], function ($routes) {
    $routes->get('/', 'Admin::dashboard');
    
    // Daftar Users Dashboard
    $routes->get('users', 'UserDashboard::index'); 
    $routes->get('users/addProses', 'UserDashboard::addProses'); 
    $routes->post('users/save', 'UserDashboard::saveData'); 
    $routes->get('users/edit/(:num)', 'UserDashboard::edit/$1'); 
    $routes->post('users/update', 'UserDashboard::update');
    $routes->delete('users/delete/(:num)', 'UserDashboard::delete/$1');
 
    // Section Lain
     $routes->get('orderdetail', 'SectionDashboard::orderdetail');
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

 
 
 