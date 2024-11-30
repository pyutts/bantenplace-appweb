<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('/login', 'Auth::login');
$routes->post('/auth/attemptLogin', 'Auth::attemptLogin');
$routes->get('/register', 'Auth::register');
$routes->post('/auth/attemptRegister', 'Auth::attemptRegister');
$routes->get('/logout', 'Auth::logout');

// Get Admin Dashboard
$routes->get('dashboard', 'Admin::dashboard');

// Get Section Menu dan Homepages
$routes->get('/user', 'User::index');
$routes->get('/about', 'SectionHome::about');
$routes->get('/shop', 'SectionHome::shop');
$routes->get('/cart', 'SectionHome::cart');
$routes->get('/testimoni', 'SectionHome::testimoni');

