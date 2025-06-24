<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Shop'); // Change from 'Home' to our new 'Shop' controller
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very convenient but creates unpredictable
// routes that may conflict with defined routes. It's recommended that you
// disable auto-routing and define all of your routes explicitly.
$routes->setAutoRoute(false); // Explicitly set to false for better security and organization

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// === PUBLIC ROUTES ===
// Accessible to everyone, no login required.
$routes->get('/', 'Shop::index');

// Authentication routes
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::attemptRegister');
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::attemptLogin');
$routes->get('logout', 'AuthController::logout');


// === LOGGED-IN USER ROUTES ===
// This group requires the user to be logged in. The 'auth' filter will
// automatically redirect guests to the login page.
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    
    // Order routes
    $routes->get('orders', 'OrdersController::index');
    $routes->post('orders/create', 'OrdersController::checkout'); // Using POST for the checkout action
    
    // Cart routes that require login (e.g., viewing, clearing)
    $routes->get('cart', 'Cart::index');
    $routes->get('cart/clear', 'Cart::clear');
    $routes->get('cart/remove/(:num)', 'Cart::remove/$1');
});

// Adding an item to the cart can be public (doesn't need the filter group).
$routes->post('cart/add', 'Cart::add');


// === ADMIN-ONLY ROUTES ===
// This group uses our 'admin_area' filter group, which first runs 'auth',
// then runs 'admin'. It also prefixes all routes with '/admin'.
$routes->group('admin', ['filter' => 'admin_area'], static function ($routes) {

    // Admin Dashboard
    $routes->get('/', 'AdminController::dashboard'); // Maps to /admin

    // Example routes for managing products
    $routes->get('products', 'Admin\ProductController::index');     // Maps to /admin/products
    $routes->get('products/new', 'Admin\ProductController::new');      // Maps to /admin/products/new
    $routes->post('products/create', 'Admin\ProductController::create');  // Maps to /admin/products/create

    // You would add more admin-specific routes here, e.g., for managing users or orders.
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}