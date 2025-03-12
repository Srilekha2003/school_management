<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultController('Register');
$routes->get('/', 'Register::index', ['filter' => 'guestFilter']);
$routes->get('/register', 'Register::index', ['filter' => 'guestFilter']);
$routes->post('/register', 'Register::register', ['filter' => 'guestFilter']);
 
$routes->get('/login', 'Login::index', ['filter' => 'guestFilter']);
$routes->post('/login', 'Login::authenticate', ['filter' => 'guestFilter']);
 
$routes->get('/logout', 'Login::logout', ['filter' => 'authFilter']);
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'authFilter']);

$routes->group("api", function ($routes) {
    $routes->post("register", "ORegister::index");
    $routes->post("login", "OLogin::index");
    $routes->get("users", "OUser::index", ['filter' => 'authFilter']);
});

