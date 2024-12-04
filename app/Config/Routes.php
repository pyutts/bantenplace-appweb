<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->get('/', 'Home::index'); // Halaman utama tanpa proteksi

 // Rute untuk otentikasi
 $routes->get('/login', 'Auth::login', ['filter' => 'noauth']);
 $routes->post('/auth/attemptLogin', 'Auth::attemptLogin', ['filter' => 'noauth']);
 $routes->get('/register', 'Auth::register', ['filter' => 'noauth']);
 $routes->post('/auth/attemptRegister', 'Auth::attemptRegister', ['filter' => 'noauth']);
 $routes->get('/logout', 'Auth::logout');
 
 // Rute untuk Admin (hanya level Admin yang dapat mengakses)
 $routes->group('dashboard', ['filter' => 'role:Admin'], function ($routes) {
     $routes->get('/', 'Admin::dashboard');
     // Tambahkan rute lain yang khusus untuk admin
 });
 
 // Rute untuk User (hanya level User yang dapat mengakses)
 $routes->group('', ['filter' => 'role:User'], function ($routes) {
     $routes->get('/user', 'User::index');
     $routes->get('/about', 'SectionHome::about');
     $routes->get('/shop', 'SectionHome::shop');
     $routes->get('/cart', 'SectionHome::cart');
     $routes->get('/testimoni', 'SectionHome::testimoni');
 });
 
 