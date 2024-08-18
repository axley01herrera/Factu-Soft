<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\ProfileModel;
use App\Models\ServicesModel;
use App\Models\MainModel;

class Services extends BaseController
{
	protected $objSession;
	protected $objRequest;

	protected $objConfig;
	protected $objProfile;
	protected $objServicesModel;
	protected $objMainModel;

	protected $config;
	protected $profile;

	public function __construct()
	{
		$this->objSession = session();

		# Models
		$this->objConfig = new ConfigModel;
		$this->objProfile = new ProfileModel;
		$this->objServicesModel = new ServicesModel;
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

		# Helper
		helper('Site');
	}

	public function index()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		$data = array();
		$data['profile'] = $this->profile;
		$data['config'] = $this->config;
		# menu
		$data['servicesActive'] = 'active';
		# page
		$data['page'] = 'services/mainServices';

		$data['services'] = $this->objServicesModel->getServices();

		return view('layouts/main', $data);
	}

	public function addEditService()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		# Params
		$serviceID = @$this->objRequest->getPost('serviceID');

		$data = array();
		$data['config'] = $this->config;
		if (empty($serviceID)) {
			$data['modalTitle'] = lang('Text.services_modal_title_create');
			$data['action'] = 'create';
		} else {
			$service = $this->objServicesModel->getServices($serviceID);
			$data['modalTitle'] = $service[0]->name;
			$data['action'] = 'update';
			$data['service'] = $service;
		}

		return view('services/addEditModal', $data);
	}

	public function saveService()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";

			return json_encode($result);
		}

		# Params
		$serviceID = $this->objRequest->getPost('serviceID');
		$name = htmlspecialchars(trim($this->objRequest->getPost('name')));
		$description = htmlspecialchars(trim($this->objRequest->getPost('description')));
		$price = htmlspecialchars(trim($this->objRequest->getPost('price')));

		$data = array();
		$data['name'] = $name;
		$data['description'] = $description;
		$data['price'] = $price;
		$data['updated'] = date('Y-m-d H:i:s');

		if (!empty($serviceID)) // Update
			$result = $this->objMainModel->objUpdate('services', $data, $serviceID);
		else { // Create
			$data['created'] = date('Y-m-d H:i:s');
			$result = $this->objMainModel->objCreate('services', $data);
		}

		return json_encode($result);
	}

	public function deleteService()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";

			return json_encode($result);
		}

		# Params
		$serviceID = $this->objRequest->getPost('serviceID');

		$data = array();
		$data['deleted'] = 1;

		$result = $this->objMainModel->objUpdate('services', $data, $serviceID);

		return json_encode($result);
	}
}
