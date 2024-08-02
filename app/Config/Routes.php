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

# Clients
$routes->get('Clients', 'Clients::index');
$routes->post('Clients/processingClients', 'Clients::processingClients');

# Company -> config
$routes->get('Company/config', 'Company::config');

# Company -> profile
$routes->get('Company/company', 'Company::company');
$routes->post('Company/saveCompanyInfo', 'Company::saveCompanyInfo');
