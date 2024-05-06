<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->get('auth/login_form', 'Auth::login');
$routes->post('auth/login_submit', 'Auth::login_submit');
