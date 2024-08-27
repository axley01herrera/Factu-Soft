<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\ProfileModel;
use App\Models\DataTableModel;
use App\Models\CustomerModel;
use App\Models\MainModel;
use App\Models\InvoiceModel;

class Customer extends BaseController
{
	protected $objSession;
	protected $objRequest;

	protected $objConfig;
	protected $objProfile;
	protected $objDataTableModel;
	protected $objCustomerModel;
	protected $objMainModel;
	protected $objInvoiceModel;

	protected $config;
	protected $profile;

	public function __construct()
	{
		$this->objSession = session();

		# Models
		$this->objConfig = new ConfigModel;
		$this->objProfile = new ProfileModel;
		$this->objDataTableModel = new DataTableModel;
		$this->objCustomerModel = new CustomerModel;
		$this->objMainModel = new MainModel;
		$this->objInvoiceModel = new InvoiceModel;

		# Services
		$this->objRequest = \Config\Services::request();

		$this->config = $this->objConfig->getConfig();
		$this->profile = $this->objProfile->getProfile();

		# Set Lang
		if (!empty($this->config)) {
			$this->objRequest->setLocale($this->config[0]->lang);
			date_default_timezone_set($this->config[0]->timezone);
		} else {
			$this->objRequest->setLocale("es");
			date_default_timezone_set("UTC");
		}
	}

	public function index()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		$data = array();
		$data['profile'] = $this->profile;
		$data['lang'] = $this->config[0]->lang;
		# menu
		$data['customerActive'] = 'active';
		# page
		$data['page'] = 'customer/mainCustomer';

		return view('layouts/main', $data);
	}

	public function processingCustomers()
	{
		$dataTableRequest = $_REQUEST;

		$params = array();
		$params['draw'] = $dataTableRequest['draw'];
		$params['start'] = $dataTableRequest['start'];
		$params['length'] = $dataTableRequest['length'];
		$params['search'] = $dataTableRequest['search']['value'];
		$params['sortColumn'] = $dataTableRequest['order'][0]['column'];
		$params['sortDir'] = $dataTableRequest['order'][0]['dir'];

		$row = array();
		$totalRecords = 0;

		$result = $this->objDataTableModel->getCustomersProcessingData($params);
		$totalRows = sizeof($result);

		for ($i = 0; $i < $totalRows; $i++) {
			$col = array();
			$col['name'] = '<a href=' . base_url('Customer/customerProfile?customerID=') . $result[$i]->id . '&tab=info' . ' class="text-primary" style="cursor: pointer;" title="' . lang('Text.customer_view_profile_label') . '">' . $result[$i]->name . '</a>';
			$col['nif'] = $result[$i]->nif;
			if ($result[$i]->type == 0) {
				$col['type'] = '<span class="badge bg-primary-subtle text-primary">' . lang('Text.customer_type_particular') . '</span>';
			} else if ($result[$i]->type == 1) {
				$col['type'] = '<span class="badge bg-success-subtle text-success">' . lang('Text.customer_type_enterprise') . '</span>';
			}

			$col['email'] = $result[$i]->email;
			$col['phone'] = $result[$i]->phone;
			$col['updated'] = $result[$i]->updated;
			$col['added'] = $result[$i]->added;
			$col['action'] = '	
			<a href="#" class="btn-edit-customer" data-customer-id=' . $result[$i]->id . '>
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
				  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
				  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
				</svg>
			</a>
			<a href="#" class="btn-delete-customer ms-2" data-customer-id=' . $result[$i]->id . '>
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
				  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
				  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
				</svg>
			</a>';
			$row[$i] =  $col;
		}

		if ($totalRows > 0)
			$totalRecords = $this->objDataTableModel->getTotalCustomers($params);

		$data = array();
		$data['draw'] = $dataTableRequest['draw'];
		$data['recordsTotal'] = intval($totalRecords);
		$data['recordsFiltered'] = intval($totalRecords);
		$data['data'] = $row;

		return json_encode($data);
	}

	public function addEditCustomer()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		# Params
		$customerID = @$this->objRequest->getPost('customerID');

		$data = array();
		if (empty($customerID)) {
			$data['modalTitle'] = lang('Text.customer_modal_title_create');
			$data['action'] = 'create';
		} else {
			$customer = $this->objCustomerModel->getCustomer($customerID);
			$data['modalTitle'] = $customer[0]->name;
			$data['action'] = 'update';
			$data['customer'] = $customer;
		}

		return view('customer/addEditModal', $data);
	}

	public function saveCustomer()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";

			return json_encode($result);
		}

		# Params
		$customerID = $this->objRequest->getPost('customerID');
		$serialID = $this->objRequest->getPost('serialID');
		$name = htmlspecialchars(trim($this->objRequest->getPost('name')));
		$type = htmlspecialchars(trim($this->objRequest->getPost('type')));
		$email = htmlspecialchars(trim($this->objRequest->getPost('email')));
		$phone = htmlspecialchars(trim($this->objRequest->getPost('phone')));
		$address_a = htmlspecialchars(trim($this->objRequest->getPost('address_a')));
		$address_city = htmlspecialchars(trim($this->objRequest->getPost('address_city')));
		$address_state = htmlspecialchars(trim($this->objRequest->getPost('address_state')));
		$address_zip = htmlspecialchars(trim($this->objRequest->getPost('address_zip')));
		$address_country = htmlspecialchars(trim($this->objRequest->getPost('address_country')));
		$nif = htmlspecialchars(trim($this->objRequest->getPost('nif')));
		$serial = htmlspecialchars(trim($this->objRequest->getPost('serial')));

		$data = array();
		$data['name'] = $name;
		if (!empty($type))
			$data['type'] = $type;
		$data['email'] = $email;
		$data['phone'] = $phone;
		$data['address_a'] = $address_a;
		$data['address_city'] = $address_city;
		$data['address_state'] = $address_state;
		$data['address_zip'] = $address_zip;
		$data['address_country'] = $address_country;
		$data['nif'] = strtoupper($nif);

		$checkExistSerialName = $this->objInvoiceModel->checkExistSerialName($serial);

		if (empty($checkExistSerialName)) {

			if (!empty($customerID)) { // Update
				$data['updated'] = date('Y-m-d H:i:s');
				$result = $this->objMainModel->objUpdate('customer', $data, $customerID);
			} else { // Create
				$data['updated'] = date('Y-m-d H:i:s');
				$data['added'] = date('Y-m-d H:i:s');
				$result = $this->objMainModel->objCreate('customer', $data);
			}

			if (empty($serialID) && !empty($serial)) {
				$data = array();
				$data['name'] = strtoupper($serial);
				$data['count'] = 0;
				$data['created'] = date('Y-m-d H:i:s');
				$data['updated'] = date('Y-m-d H:i:s');

				$rs = $this->objMainModel->objCreate('serial', $data); // Create Serial

				$data = array();
				$data['serial_id'] = $rs['id'];

				if (!empty($customerID)) {
					$this->objMainModel->objUpdate('customer', $data, $customerID);
				} else { // Create
					$this->objMainModel->objUpdate('customer', $data, $result['id']);
				}
			}
		} else {
			$result = array();
			$result['error'] = 1;
			$result['msg'] = 'DUPLICATE_SERIAL_NAME';
		}

		return json_encode($result);
	}

	public function deleteCustomer()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";

			return json_encode($result);
		}

		# Params
		$customerID = $this->objRequest->getPost('customerID');

		$data = array();
		$data['deleted'] = 1;

		$result = $this->objMainModel->objUpdate('customer', $data, $customerID);

		return json_encode($result);
	}

	public function customerProfile()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		# Params
		$customerID = $this->objRequest->getPostGet('customerID');
		$tab = $this->objRequest->getPostGet('tab');

		if (empty($tab)) {
			$tab = 'info';
		}

		$customer = $this->objCustomerModel->getCustomer($customerID);

		$data = array();
		$data['profile'] = $this->profile;
		# menu
		$data['customerActive'] = 'active';
		# page
		$data['page'] = 'customer/customerProfile';
		$data['customer'] = $customer;
		$data['tab'] = $tab;

		return view('layouts/main', $data);
	}

	public function getTabContent()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		# Params
		$tab = $this->objRequest->getPostGet('tab');
		$customerID = $this->objRequest->getPostGet('customerID');

		$customer = $this->objCustomerModel->getCustomer($customerID);

		$data = array();
		$data['customer'] = $customer;

		switch ($tab) {
			case 'info':
				$view = 'customer/customerProfile/tabs/info';
				break;
			case 'invoices':
				$view = 'customer/customerProfile/tabs/invoices';
				break;
		}

		return view($view, $data);
	}
}
