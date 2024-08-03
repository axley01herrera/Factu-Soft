<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\ProfileModel;
use App\Models\DataTableModel;

class Customer extends BaseController
{
	protected $objSession;
	protected $objRequest;

	protected $objConfig;
	protected $objProfile;
	protected $objDataTableModel;

	protected $config;
	protected $profile;

	public function __construct()
	{
		$this->objSession = session();

		# Models
		$this->objConfig = new ConfigModel;
		$this->objProfile = new ProfileModel;
		$this->objDataTableModel = new DataTableModel;

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
				$col['type'] = '<span class="badge bg-primary">Particular</span>';
			else if ($result[$i]->type == 1)
				$col['type'] = '<span class="badge bg-primary">Empresa</span>';

			$col['email'] = $result[$i]->email;
			$col['phone'] = $result[$i]->phone;

			if ($result[$i]->deleted == 1)
				$col['status'] = '<span class="badge bg-danger">Eliminado</span>';
			else
				$col['status'] = '<span class="badge bg-success">Activo</span>';

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
}
