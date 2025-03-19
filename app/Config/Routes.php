<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->setDefaultController('Register');
$routes->get('/', 'Register::index', ['filter' => 'guestFilter']);
$routes->get('/register', 'Register::index', ['filter' => 'guestFilter']);
$routes->post('/register', 'Register::register', ['filter' => 'guestFilter']);
 
$routes->get('/login', 'Login::index', ['filter' => 'guestFilter']);
$routes->post('/login', 'Login::authenticate', ['filter' => 'guestFilter']);
 
$routes->get('/logout', 'Login::logout', ['filter' => 'authFilter']);
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'authFilter']);
// Admin
$routes->get('admin', 'Admin::index');           
$routes->get('admin/(:num)', 'Admin::view/$1');  
$routes->post('admin', 'Admin::create');
$routes->get('admin/edit/(:num)', 'Admin::edit/$1');         
$routes->post('admin/(:num)', 'Admin::update/$1'); 
$routes->delete('admin/(:num)', 'Admin::delete/$1');
// Setting
$routes->get('setting', 'Setting::index');           
$routes->get('setting/(:num)', 'Setting::view/$1');  
$routes->post('setting', 'Setting::create');
$routes->get('setting/edit/(:num)', 'Setting::edit/$1');         
$routes->post('setting/(:num)', 'Setting::update/$1'); 
$routes->delete('setting/(:num)', 'Setting::delete/$1');


$routes->group("api", function ($routes) {
    $routes->post("register", "ORegister::index");
    $routes->post("login", "OLogin::index");
    $routes->get("users", "OUser::index", ['filter' => 'authFilter']);
});

