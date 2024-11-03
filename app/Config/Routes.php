<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Product Routes
$routes->get('products', 'ProductController::index');
$routes->get('products/create', 'ProductController::create');
$routes->post('products/store', 'ProductController::store');
$routes->get('products/edit/(:num)', 'ProductController::edit/$1');
$routes->post('products/update/(:num)', 'ProductController::update/$1');
$routes->get('products/delete/(:num)', 'ProductController::delete/$1');
$routes->get('/', 'AuthController::register');
$routes->post('/registerUser', 'AuthController::registerUser');
$routes->get('/login', 'AuthController::login');
$routes->post('/loginUser', 'AuthController::loginUser');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/home', 'ProductController::home');

$routes->get('cart/add/(:num)', 'CartController::add/$1');
$routes->get('cart', 'CartController::index');

$routes->get('comments', 'CommentController::index');
$routes->post('comments/store', 'CommentController::store');


$routes->get('cart/order', 'CartController::order');
$routes->get('cart/order', 'OrderController::order');
$routes->post('order', 'OrderController::order');