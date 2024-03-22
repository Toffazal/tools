<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('/daftar', 'Home::daftar');
$routes->get('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');
$routes->get('/akun', 'Home::akun');
$routes->get('/aktivasi', 'Home::aktivasi');
$routes->get('/aktivasi/(:num)', 'Home::aktivasi/$1');
$routes->get('/upgrade', 'Home::upgrade');
$routes->get('/upgrade/(:num)', 'Home::upgrade/$1');
$routes->get('/hapusAkun', 'Home::hapusAkun');
$routes->get('/hapusAkun/(:num)', 'Home::hapusAkun/$1');
$routes->get('/downgrade', 'Home::downgrade');
$routes->get('/downgrade/(:num)', 'Home::downgrade/$1');
$routes->get('/gps/(:num)/(:any)', 'Gps::lokasi/$1/$2');
$routes->get('/iptracking/(:num)/(:any)', 'Iptracking::lokasi/$1/$2');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}