<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', 'Auth::index',['filter' => 'authenticated']);
$routes->get('/register', 'Auth::register',['filter' => 'authenticated']);
$routes->get('/Auth', 'Auth::index',['filter' => 'authenticated']);
$routes->get('/update_user', 'Auth::update_user',['filter' => 'authenticate']);
$routes->match(['post'], '/update_user', 'Auth::update_user',['filter' => 'authenticate']);
$routes->get('/Auth/(:segment)', 'Auth::$1',['filter' => 'authenticated']);
$routes->match(['post'], '/register', 'Auth::register',['filter' => 'authenticated']);
$routes->match(['post'], '/login', 'Auth::index',['filter' => 'authenticated']);
$routes->get('/logout', 'Auth::logout');

$routes->group('Main', ['filter' => 'authenticate'], static function($routes){
    $routes->get('', 'Main::index');
    $routes->get('(:segment)', 'Main::$1');
    $routes->get('(:segment)/(:any)', 'Main::$1/$2');
    $routes->match(['post'], 'user_add', 'Main::user_add');
    $routes->match(['post'], 'user_edit/(:num)', 'Main::user_edit/$1');
    $routes->match(['post'], 'employee_edit/(:num)', 'Main::employee_edit/$1');
    $routes->match(['post'], 'employee_add', 'Main::employee_add');
});
$routes->group('Attendance', static function($routes){
    $routes->get('', 'Attendance::index');
    $routes->get('(:segment)', 'Attendance::$1');
    $routes->get('(:segment)/(:any)', 'Attendance::$1/$2');
    $routes->match(['post'], 'add', 'Attendance::add');
});

