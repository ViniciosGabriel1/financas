<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Login
$routes->get('auth/login_form', 'Auth::login');
$routes->post('auth/login_submit', 'Auth::login_submit');


//Register
$routes->get('register/register_form', 'Register::register');
$routes->post('register/register_submit', 'Register::register_submit');

//Logout
$routes->get('auth/logout', 'Auth::logout');



//DashBoard

$routes->get('dash/index', 'Dash::index');



