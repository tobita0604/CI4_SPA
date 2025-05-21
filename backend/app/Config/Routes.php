<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// API Routes
$routes->group('api', function ($routes) {
    $routes->get('/', 'Api::index');
    $routes->post('login', 'Api::login');
    $routes->get('user', 'Api::user');
    
    // Items routes
    $routes->get('items', 'Items::index');
    $routes->get('items/(:num)', 'Items::show/$1');
    $routes->post('items', 'Items::create');
    $routes->put('items/(:num)', 'Items::update/$1');
    $routes->delete('items/(:num)', 'Items::delete/$1');
});

// Catch-all route for SPA (This will be handled by the frontend)
$routes->get('(:any)', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}