<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->setDefaultController('Register');
$routes->get('/', 'Register::index', ['filter' => 'guestFilter']);
$routes->get('register', 'AdminRegister::index', ['filter' => 'guestFilter']);
$routes->post('register', 'AdminRegister::register', ['filter' => 'guestFilter']);

 
$routes->post('authenticate', 'AdminLogin::authenticate'); 
$routes->post('chpwd', 'Login::chpwd'); 
$routes->get('logout', 'Login::logout');







 
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
// Classes Routes
$routes->get('classes', 'Classes::index');           
$routes->get('classes/(:num)', 'Classes::view/$1');  
$routes->post('classes', 'Classes::create');
$routes->get('classes/edit/(:num)', 'Classes::edit/$1');         
$routes->post('classes/(:num)', 'Classes::update/$1'); 
$routes->delete('classes/(:num)', 'Classes::delete/$1');
// Fee Routes
$routes->get('fee', 'Fee::index');           
$routes->get('fee/(:num)', 'Fee::view/$1');  
$routes->post('fee', 'Fee::create');
$routes->get('fee/edit/(:num)', 'Fee::edit/$1');         
$routes->post('fee/(:num)', 'Fee::update/$1'); 
$routes->delete('fee/(:num)', 'Fee::delete/$1');
// Timetable Routes
$routes->get('timetable', 'Timetable::index');           
$routes->get('timetable/(:num)', 'Timetable::view/$1');  
$routes->post('timetable', 'Timetable::create');
$routes->get('timetable/edit/(:num)', 'Timetable::edit/$1');      
$routes->post('timetable/(:num)', 'Timetable::update/$1'); 
$routes->delete('timetable/(:num)', 'Timetable::delete/$1');
// Notification Routes
$routes->get('notification', 'Notification::index');           
$routes->get('notification/(:num)', 'Notification::view/$1');  
$routes->post('notification', 'Notification::create');
$routes->get('notification/edit/(:num)', 'Notification::edit/$1');      
$routes->post('notification/(:num)', 'Notification::update/$1'); 
$routes->delete('notification/(:num)', 'Notification::delete/$1');  
// MedicalRecord Routes
$routes->get('medicalrecord', 'MedicalRecord::index');           
$routes->get('medicalrecord/(:num)', 'MedicalRecord::view/$1');  
$routes->post('medicalrecord', 'MedicalRecord::create');
$routes->get('medicalrecord/edit/(:num)', 'MedicalRecord::edit/$1');      
$routes->post('medicalrecord/(:num)', 'MedicalRecord::update/$1'); 
$routes->delete('medicalrecord/(:num)', 'MedicalRecord::delete/$1');  
// Homework Routes
$routes->get('homework', 'Homework::index');           
$routes->get('homework/(:num)', 'Homework::view/$1');  
$routes->post('homework', 'Homework::create');
$routes->get('homework/edit/(:num)', 'Homework::edit/$1');      
$routes->post('homework/(:num)', 'Homework::update/$1'); 
$routes->delete('homework/(:num)', 'Homework::delete/$1');  
// Library Routes
$routes->get('library', 'Library::index');           
$routes->get('library/(:num)', 'Library::view/$1');  
$routes->post('library', 'Library::create');
$routes->get('library/edit/(:num)', 'Library::edit/$1');      
$routes->post('library/(:num)', 'Library::update/$1'); 
$routes->delete('library/(:num)', 'Library::delete/$1');
// Driver Routes
$routes->get('driver', 'Driver::index');           
$routes->get('driver/(:num)', 'Driver::view/$1');  
$routes->post('driver', 'Driver::create');
$routes->get('driver/edit/(:num)', 'Driver::edit/$1');      
$routes->post('driver/(:num)', 'Driver::update/$1'); 
$routes->delete('driver/(:num)', 'Driver::delete/$1');



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
// ProgressCard
$routes->get('progresscard', 'ProgressCard::index');           
$routes->get('progresscard/(:num)', 'ProgressCard::view/$1');  
$routes->post('progresscard', 'Student::ProgressCard');
$routes->get('progresscard/edit/(:num)', 'ProgressCard::edit/$1');         
$routes->post('progresscard/(:num)', 'ProgressCard::update/$1'); 
$routes->delete('progresscard/(:num)', 'ProgressCard::delete/$1');  

// Cultural
$routes->get('cultural', 'Cultural::index');           
$routes->get('cultural/(:num)', 'Cultural::view/$1');  
$routes->post('cultural', 'Student::Cultural');
$routes->get('cultural/edit/(:num)', 'Cultural::edit/$1');         
$routes->post('cultural/(:num)', 'Cultural::update/$1'); 
$routes->delete('cultural/(:num)', 'Cultural::delete/$1');  

// ExamScore
$routes->get('examscore', 'ExamScore::index');           
$routes->get('examscore/(:num)', 'ExamScore::view/$1');  
$routes->post('examscore', 'Student::ExamScore');
$routes->get('examscore/edit/(:num)', 'ExamScore::edit/$1');         
$routes->post('examscore/(:num)', 'ExamScore::update/$1'); 
$routes->delete('examscore/(:num)', 'ExamScore::delete/$1');  

// Exam
$routes->get('exam', 'Exam::index');           
$routes->get('exam/(:num)', 'Exam::view/$1');  
$routes->post('exam', 'Student::Exam');
$routes->get('exam/edit/(:num)', 'Exam::edit/$1');         
$routes->post('exam/(:num)', 'Exam::update/$1'); 
$routes->delete('exam/(:num)', 'Exam::delete/$1');  

// Transport
$routes->get('transport', 'Transport::index');           
$routes->get('transport/(:num)', 'Transport::view/$1');  
$routes->post('transport', 'Student::Transport');
$routes->get('transport/edit/(:num)', 'Transport::edit/$1');         
$routes->post('transport/(:num)', 'Transport::update/$1'); 
$routes->delete('transport/(:num)', 'Transport::delete/$1');  

// TransportRoute
$routes->get('transportroutes', 'TransportRoutes::index');           
$routes->get('transportroutes/(:num)', 'TransportRoutes::view/$1');  
$routes->post('transportroutes', 'Student::TransportRoutes');
$routes->get('transportroutes/edit/(:num)', 'TransportRoutes::edit/$1');         
$routes->post('transportroutes/(:num)', 'TransportRoutes::update/$1'); 
$routes->delete('transportroutes/(:num)', 'TransportRoutes::delete/$1');  

// Bus
$routes->get('bus', 'Bus::index');           
$routes->get('bus/(:num)', 'Bus::view/$1');  
$routes->post('bus', 'Student::Bus');
$routes->get('bus/edit/(:num)', 'Bus::edit/$1');         
$routes->post('bus/(:num)', 'Bus::update/$1'); 
$routes->delete('bus/(:num)', 'Bus::delete/$1');  

// Hostel
$routes->get('hostel', 'Hostel::index');           
$routes->get('hostel/(:num)', 'Hostel::view/$1');  
$routes->post('hostel', 'Student::Hostel');
$routes->get('hostel/edit/(:num)', 'Hostel::edit/$1');         
$routes->post('hostel/(:num)', 'Hostel::update/$1'); 
$routes->delete('hostel/(:num)', 'Hostel::delete/$1');  
// Subject Routes

$routes->get('subject', 'Subject::index');              
$routes->get('subject/(:num)', 'Subject::view/$1');     
$routes->post('subject', 'Subject::create');            
$routes->get('subject/edit/(:num)', 'Subject::edit/$1'); 
$routes->post('subject/(:num)', 'Subject::update/$1'); 
$routes->delete('subject/(:num)', 'Subject::delete/$1'); 


$routes->group("api", function ($routes) {
    $routes->post("register", "ORegister::index");
    $routes->post("login", "OLogin::index");
    $routes->get("users", "OUser::index", ['filter' => 'authFilter']);
});

