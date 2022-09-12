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
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login');
$routes->post('/verify', 'Auth::verify');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index');

//user
$routes->get('/user/generate', 'User::generate');
$routes->get('/user/listing', 'User::listing');
$routes->get('/user/create', 'User::create');
$routes->get('/user/update/(:any)', 'User::update/$1');
$routes->get('/user/delete/(:any)', 'User::delete/$1');
$routes->get('/user/vlisting', 'User::vlisting');

$routes->post('/user/save', 'User::save');
$routes->post('/user/save/(:any)', 'User::save/$1');

//api
$routes->post('/apiuser/list', 'ApiUser::list');
$routes->post('/apiuser/change', 'ApiUser::change');
$routes->post('/apiuser/remove', 'ApiUser::remove');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
