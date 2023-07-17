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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');

//Metodos Get

$routes->get('/', 'RegisterController::index');
$routes->get('/login', 'LoginController::index');
$routes->get('/movies', 'MovieController::index');
$routes->get('/update-info', 'LoginController::getInfo');
$routes->get('/movies/reservation', 'MovieController::reservationView');


//Metodos Post

$routes->post('/send-register', 'RegisterController::createClient');
$routes->post('/login/send', 'LoginController::validateInfo');
$routes->post('/close', 'LoginController::logout');
$routes->post('/movies/reservation/save', 'TicketController::createTicket');
$routes->post('/movies/reservation/cancel', 'TicketController::deleteProcess');
$routes->post('/movies/show', 'TicketController::showReservation');
$routes->post('/movies/complete', 'TicketController::saveReservation');
$routes->post('/update-info/complete', 'RegisterController::updateUser');




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