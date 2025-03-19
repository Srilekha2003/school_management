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

//teacher

$routes->get('teacher', 'Teacher::index');           
$routes->get('teacher/(:num)', 'Teacher::view/$1');  
$routes->post('teacher', 'Teacher::create');
$routes->get('teacher/edit/(:num)', 'teacher::edit/$1');         
$routes->post('teacher/(:num)', 'Teacher::update/$1'); 
$routes->delete('teacher/(:num)', 'Teacher::delete/$1'); 

//students
$routes->get('student', 'Student::index');           
$routes->get('student/(:num)', 'Student::view/$1');  
$routes->post('student', 'Student::create');
$routes->get('student/edit/(:num)', 'Student::edit/$1');         
$routes->post('student/(:num)', 'Student::update/$1'); 
$routes->delete('student/(:num)', 'Student::delete/$1');

//parents
$routes->get('parents', 'Parents::index');           
$routes->get('parents/(:num)', 'Parents::view/$1');  
$routes->post('parents', 'Parents::create');
$routes->get('parents/edit/(:num)', 'Parents::edit/$1');         
$routes->post('parents/(:num)', 'Parents::update/$1');
$routes->delete('parents/(:num)', 'Parents::delete/$1');

//Attendence
$routes->get('attendance', 'Attendance::index');           
$routes->get('attendance/(:num)', 'Attendance::view/$1');  
$routes->post('attendance', 'Student::Attendance');
$routes->get('attendance/edit/(:num)', 'Attendance::edit/$1');         
$routes->post('attendance/(:num)', 'Attendance::update/$1'); 
$routes->delete('attendance/(:num)', 'Attendance::delete/$1'); 





$routes->group("api", function ($routes) {
    $routes->post("register", "ORegister::index");
    $routes->post("login", "OLogin::index");
    $routes->get("users", "OUser::index", ['filter' => 'authFilter']);
});

