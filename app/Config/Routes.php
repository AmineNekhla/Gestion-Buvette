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
$routes->get('/register', 'AuthController::register');
$routes->post('/registerUser', 'AuthController::registerUser');
$routes->get('/login', 'AuthController::login');
$routes->post('/loginUser', 'AuthController::loginUser');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/', 'ProductController::home');

$routes->get('cart/add/(:num)', 'CartController::add/$1');
$routes->get('cart', 'CartController::index');

$routes->get('comments', 'CommentController::index');
$routes->post('comments/store', 'CommentController::store');


$routes->get('cart/validate', 'CartController::validateOrder');

$routes->get('/manage-orders', 'OrderController::manageOrders');
$routes->get('cart/remove/(:num)', 'CartController::remove/$1');
$routes->get('order/validateO/(:num)', 'OrderController::validateO/$1');


$routes->get('/orders/manage', 'OrderController::manageOrders');
$routes->get('/order/validate/(:num)', 'OrderController::validateO/$1');
$routes->post('/order/saveValidation', 'OrderController::saveValidation');


$routes->get('/productsForm', 'ProductFormController::index');
$routes->post('/productsForm/add', 'ProductFormController::add');

// Route to view user responses (for logged-in users)
$routes->get('/responses', 'ResponseController::index');

// Route to fetch a specific response (using its ID)
$routes->get('/response/get/(:num)', 'ResponseController::getResponse/$1');



// Route for schema synchronization
$routes->get('/response/sync-schemas', 'ResponseController::syncSchemas');

// Route for data migration
$routes->get('/response/migrate', 'ResponseController::migrateResponses');

// Route for combined schema sync and migration
$routes->get('/response/migrate-and-sync', 'ResponseController::migrateAndSync');

$routes->cli('migrate-responses', 'ResponseController::migrateCli');
