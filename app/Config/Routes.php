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
$routes->get('Customer/customerProfile', 'Customer::customerProfile');
$routes->post('Customer/processingCustomers', 'Customer::processingCustomers');
$routes->post('Customer/addEditCustomer', 'Customer::addEditCustomer');
$routes->post('Customer/saveCustomer', 'Customer::saveCustomer');
$routes->post('Customer/deleteCustomer', 'Customer::deleteCustomer');
$routes->post('Customer/getTabContent', 'Customer::getTabContent');

# Services
$routes->get('Services', 'Services::index');
$routes->post('Services/addEditService', 'Services::addEditService');
$routes->post('Services/saveService', 'Services::saveService');
$routes->post('Services/deleteService', 'Services::deleteService');

# Invoices
$routes->get('Invoice', 'Invoice::index');
$routes->get('Invoice/series', 'Invoice::series');
$routes->post('Invoice/createSerie', 'Invoice::createSerie');
$routes->post('Invoice/createSerieProcess', 'Invoice::createSerieProcess');
$routes->post('Invoice/processingInvoices', 'Invoice::processingInvoices');

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

# TPV
$routes->get('TPV', 'TPV::index');
$routes->post('TPV/invoiceItems', 'TPV::invoiceItems');
$routes->post('TPV/addInvoiceItem', 'TPV::addInvoiceItem');
$routes->post('TPV/clearInvoiceItems', 'TPV::clearInvoiceItems');
$routes->post('TPV/removeInvoiceItem', 'TPV::removeInvoiceItem');
$routes->post('TPV/changeQuantity', 'TPV::changeQuantity');
$routes->post('TPV/editPriceTPV', 'TPV::editPriceTPV');
$routes->post('TPV/editPriceProcessTPV', 'TPV::editPriceProcessTPV');
$routes->post('TPV/saveInvoice', 'TPV::saveInvoice');
$routes->get('TPV/printTicket', 'TPV::printTicket');
