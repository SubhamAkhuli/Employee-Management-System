<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');

// Authentication Routes
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::loginPost');
$routes->get('logout', 'Auth::logout');

// Employee Management Routes
$routes->get('employees', 'EmployeeController::index');
$routes->get('employee/create', 'EmployeeController::create');
$routes->post('employee/store', 'EmployeeController::store');
$routes->get('employee/edit/(:num)', 'EmployeeController::edit/$1');
$routes->post('employee/update/(:num)', 'EmployeeController::update/$1');
$routes->get('employee/delete/(:num)', 'EmployeeController::delete/$1');
