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
$routes->post('Customer/addEditCustomer', 'Customer::addEditCustomer');
$routes->post('Customer/saveCustomer', 'Customer::saveCustomer');
$routes->post('Customer/deleteCustomer', 'Customer::deleteCustomer');

# Invoices
$routes->get('Invoice', 'Invoice::index');
$routes->get('Invoice/series', 'Invoice::series');

# Profile
$routes->get('Profile', 'Profile::index');
$routes->post('Profile/updateProfile', 'Profile::updateProfile');
$routes->post('Profile/editCompanyLogo', 'Profile::editCompanyLogo');
$routes->post('Profile/uploadLogo', 'Profile::uploadLogo');
$routes->post('Profile/changePassword', 'Profile::changePassword');
$routes->post('Profile/changePasswordProcess', 'Profile::changePasswordProcess');

# Config
$routes->get('Config', 'Config::index');
$routes->post('Config/saveConfig', 'Config::saveConfig');
