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
$routes->post('Customer/processingCustomers', 'Customer::processingCustomers');

# Invoices
$routes->get('Invoice', 'Invoice::index');
$routes->get('Invoice/series', 'Invoice::series');

# Profile
$routes->get('Profile', 'Profile::index');
$routes->post('Profile/updateProfile', 'Profile::updateProfile');
$routes->post('Profile/editCompanyLogo', 'Profile::editCompanyLogo');
$routes->post('Profile/uploadLogo', 'Profile::uploadLogo');

# Config
$routes->get('Config', 'Config::index');


