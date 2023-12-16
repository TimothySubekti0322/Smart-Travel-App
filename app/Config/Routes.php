<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/success', 'Home::success');

$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::auth');
$routes->get('/logout', 'Logout::index');
$routes->get('/register', 'Register::index');
$routes->post('/register', 'Register::register');

$routes->get('/book/(:num)', 'BookController::index/$1');
$routes->get('/api/book', 'BookController::getAllBooks');
$routes->post('/api/book', 'BookController::create');
$routes->post('/api/checkSeat', 'BookController::checkSeat');

$routes->get('/api/package', 'PackageController::index');
$routes->get('/api/package/(:num)', 'PackageController::show/$1');
$routes->post('/api/package', 'PackageController::create');

$routes->get('/api/bookAnalytics', 'BookController::getBookAnalytics');

$routes->get('/admin/bookChart', 'Home::adminBookChart');
