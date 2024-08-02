<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

# Home
$routes->get('Home/index', 'Home::index');
$routes->post('Home/login', 'Home::login');

# Dashboard
$routes->get('Dashboard', 'Dashboard::index');

# Customers
$routes->get('Customer', 'Customer::index');

# Invoices
$routes->get('Invoice', 'Invoice::index');
$routes->get('Invoice/series', 'Invoice::series');

# Profile
$routes->get('Profile', 'Profile::index');

# Config
$routes->get('Config', 'Config::index');


