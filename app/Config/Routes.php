<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/products/index', 'ProductController::index');
$routes->get('/products/create', 'ProductController::create');
$routes->post('/products/store', 'ProductController::store');
$routes->get('/products/edit/(:num)', 'ProductController::edit/$1');
$routes->post('/products/update/(:num)', 'ProductController::update/$1');
$routes->get('/products/delete/(:num)', 'ProductController::delete/$1');

$routes->get('/categories/index', 'CategoryController::index');
$routes->get('/categories/create', 'CategoryController::create');
$routes->post('/categories/store', 'CategoryController::store');
$routes->get('/categories/edit/(:num)', 'CategoryController::edit/$1');
$routes->post('/categories/update/(:num)', 'CategoryController::update/$1');
$routes->get('/categories/delete/(:num)', 'CategoryController::delete/$1');

$routes->get('/customers/index', 'CustomerController::index');
$routes->get('/customers/create', 'CustomerController::create');
$routes->post('/customers/store', 'CustomerController::store');
$routes->get('/customers/edit/(:num)', 'CustomerController::edit/$1');
$routes->post('/customers/update/(:num)', 'CustomerController::update/$1');
$routes->get('/customers/delete/(:num)', 'CustomerController::delete/$1');


$routes->get('/cart/index','CartController::index');
$routes->get('/cart/view/(:num)', 'CartController::view/$1');
$routes->get('/cart/add/(:num)', 'CartController::add/$1');
$routes->post('/cart/addToCart', 'CartController::addToCart');
$routes->get('/cart/remove/(:num)', 'CartController::remove/$1');
$routes->get('/cart/clear/(:num)', 'CartController::clear/$1');


$routes->get('/invoice/create/(:num)', 'InvoiceController::create/$1');
$routes->post('/invoice/store', 'InvoiceController::store');
$routes->get('/invoice/view/(:num)', 'InvoiceController::view/$1');
$routes->get('/invoices', 'InvoiceController::index');
