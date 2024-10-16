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
$routes->post('Dashboard/collectionDay', 'Dashboard::collectionDay');
$routes->post('Dashboard/customers', 'Dashboard::customers');
$routes->post('Dashboard/services', 'Dashboard::services');
$routes->post('Dashboard/chartMont', 'Dashboard::chartMont');
$routes->post('Dashboard/pendingInvoices', 'Dashboard::pendingInvoices');
$routes->post('Dashboard/getPendingInvoicesDT', 'Dashboard::getPendingInvoicesDT');

# Reports
$routes->get('Reports', 'Reports::index');
$routes->post('Reports/getReports', 'Reports::getReports');

# Customers
$routes->get('Customer', 'Customer::index');
$routes->get('Customer/customerProfile', 'Customer::customerProfile');
$routes->post('Customer/processingCustomers', 'Customer::processingCustomers');
$routes->post('Customer/addEditCustomer', 'Customer::addEditCustomer');
$routes->post('Customer/saveCustomer', 'Customer::saveCustomer');
$routes->post('Customer/deleteCustomer', 'Customer::deleteCustomer');
$routes->post('Customer/getTabContent', 'Customer::getTabContent');
$routes->post('Customer/processingInvoice', 'Customer::processingInvoice');

# Services
$routes->get('Services', 'Services::index');
$routes->post('Services/addEditService', 'Services::addEditService');
$routes->post('Services/saveService', 'Services::saveService');
$routes->post('Services/deleteService', 'Services::deleteService');
$routes->post('Services/showOrderModal', 'Services::showOrderModal');
$routes->post('Services/updateServicesOrder', 'Services::updateServicesOrder');

# Invoices
$routes->get('Invoice/invoice', 'Invoice::invoice');
$routes->get('Invoice/createInvoice', 'Invoice::createInvoice');
$routes->get('Invoice/editInvoice', 'Invoice::editInvoice');
$routes->post('Invoice/objUpdateInvoice', 'Invoice::objUpdateInvoice');
$routes->post('Invoice/addLineItem', 'Invoice::addLineItem');
$routes->post('Invoice/addLineItemProcess', 'Invoice::addLineItemProcess');
$routes->post('Invoice/removeItem', 'Invoice::removeItem');
$routes->post('Invoice/issueInvoice', 'Invoice::issueInvoice');
$routes->get('Invoice/print', 'Invoice::print');
$routes->get('Invoice/series', 'Invoice::series');
$routes->post('Invoice/createSerie', 'Invoice::createSerie');
$routes->post('Invoice/createSerieProcess', 'Invoice::createSerieProcess');
$routes->get('Invoice/ticket', 'Invoice::ticket');
$routes->post('Invoice/processingTickets', 'Invoice::processingTickets');
$routes->post('Invoice/processingInvoice', 'Invoice::processingInvoice');
$routes->post('Invoice/deleteInvoice', 'Invoice::deleteInvoice');
$routes->post('Invoice/payInvoice', 'Invoice::payInvoice');
$routes->get('Invoice/rectifyInvoice', 'Invoice::rectifyInvoice');
$routes->get('Invoice/finishRectifyInvoice', 'Invoice::finishRectifyInvoice');
$routes->get('Invoice/invoiceDetail', 'Invoice::invoiceDetail');
$routes->post('Invoice/addTaxToInvoice', 'Invoice::addTaxToInvoice');
$routes->post('Invoice/removeTaxInvoice', 'Invoice::removeTaxInvoice');
$routes->post('Invoice/payInvoiceModal', 'Invoice::payInvoiceModal');

# Taxs
$routes->get('Taxs', 'Taxs::index');
$routes->post('Taxs/createTax', 'Taxs::createTax');
$routes->post('Taxs/editTax', 'Taxs::editTax');
$routes->post('Taxs/deleteTax', 'Taxs::deleteTax');
$routes->post('Taxs/saveTax', 'Taxs::saveTax');
$routes->post('Taxs/setTPV', 'Taxs::setTPV');

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

# DB Backup
$routes->post('Backup/createBackup', 'Backup::createBackup');

# Bills
$routes->get('Bills/uploadFiles', 'Bills::uploadFiles');
$routes->get('Bills/fileList', 'Bills::fileList');
$routes->post('Bills/uploadFilesProccess', 'Bills::uploadFilesProccess');
$routes->post('Bills/deleteUploadFile', 'Bills::deleteUploadFile');
$routes->post('Bills/proccesingFilesDT', 'Bills::proccesingFilesDT');
