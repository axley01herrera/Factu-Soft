<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\ProfileModel;
use App\Models\DataTableModel;
use App\Models\CustomerModel;
use App\Models\MainModel;

class Customer extends BaseController
{
	protected $objSession;
	protected $objRequest;

	protected $objConfig;
	protected $objProfile;
	protected $objDataTableModel;
	protected $objCustomerModel;
	protected $objMainModel;

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
			$col['name'] = $result[$i]->name;
			$col['lastName'] = $result[$i]->last_name;

			if ($result[$i]->type == 0)
				$col['type'] = lang('Text.customer_type_particular');
			else if ($result[$i]->type == 1)
				$col['type'] = lang('Text.customer_type_enterprise');

			$col['email'] = $result[$i]->email;
			$col['phone'] = $result[$i]->phone;

			if ($result[$i]->deleted == 1)
				$col['status'] = '<span class="text-danger">' . lang('Text.status_deleted') . '</span>';
			else
				$col['status'] = '<span class="text-primary">' . lang('Text.status_active') . '</span>';

			if ($result[$i]->deleted == 0) {
				$col['action'] = '	
			<button type="button" class="btn btn-sm btn-rounded btn-outline-primary border-0 btn-edit-customer" data-customer-id=' . $result[$i]->id . '>
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
					<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
					<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
				</svg>
			</button>
			
			<button type="button" class="btn btn-sm btn-rounded btn-outline-danger border-0 btn-delete-customer" data-customer-id=' . $result[$i]->id . '>
			<i class="fas fa-trash fs-3"></i>
			</button>';
			} else
				$col['action'] = '';

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
			$data['modalTitle'] = lang('Text.customer_modal_title_update');
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
		$name = htmlspecialchars(trim($this->objRequest->getPost('name')));
		$last_name = htmlspecialchars(trim($this->objRequest->getPost('last_name')));
		$type = htmlspecialchars(trim($this->objRequest->getPost('type')));
		$email = htmlspecialchars(trim($this->objRequest->getPost('email')));
		$phone = htmlspecialchars(trim($this->objRequest->getPost('phone')));
		$address_a = htmlspecialchars(trim($this->objRequest->getPost('address_a')));
		$address_city = htmlspecialchars(trim($this->objRequest->getPost('address_city')));
		$address_state = htmlspecialchars(trim($this->objRequest->getPost('address_state')));
		$address_zip = htmlspecialchars(trim($this->objRequest->getPost('address_zip')));
		$address_country = htmlspecialchars(trim($this->objRequest->getPost('address_country')));

		$data = array();
		$data['name'] = $name;
		$data['last_name'] = $last_name;
		$data['type'] = $type;
		$data['email'] = $email;
		$data['phone'] = $phone;
		$data['address_a'] = $address_a;
		$data['address_city'] = $address_city;
		$data['address_state'] = $address_state;
		$data['address_zip'] = $address_zip;
		$data['address_country'] = $address_country;

		if (!empty($customerID)) # Update
			$result = $this->objMainModel->objUpdate('customer', $data, $customerID);
		else # Create
			$result = $this->objMainModel->objCreate('customer', $data);

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
}
