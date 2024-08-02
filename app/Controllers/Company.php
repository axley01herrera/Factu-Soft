<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\ProfileModel;
use App\Models\MainModel;

class Company extends BaseController
{
	protected $objSession;
	protected $objRequest;
	protected $objConfig;
	protected $objProfile;
	protected $objMainModel;
	protected $config;
	protected $company;

	public function __construct()
	{
		$this->objSession = session();

		# Models
		$this->objConfig = new ConfigModel;
		$this->objProfile = new ProfileModel;
		$this->objMainModel = new MainModel;

		# Services
		$this->objRequest = \Config\Services::request();

		$this->config = $this->objConfig->getConfig();
		$this->company = $this->objProfile->getProfile();

		# Set Lang
		if (!empty($this->config)) {
			$this->objRequest->setLocale($this->config[0]->lang);
			date_default_timezone_set($this->config[0]->timezone);
		} else {
			$this->objRequest->setLocale("es");
			date_default_timezone_set("UTC");
		}
	}

	public function config()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		$data = array();
		$data['page'] = 'admin/settings/config/mainConfig';

		# Company
		$data['company'] = $this->company;

		# Page Title
		$data['pageTitle'] = 'Configuración';

		# Tab
		$data['tab'] = 'settings';
		$data['subTab'] = 'config';

		return view(MAIN_ADMIN, $data);
	}

	#####################################
	# Company
	#####################################

	public function company()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		$data = array();
		$data['page'] = 'admin/settings/company/mainCompany';
		$data['uniqid'] = uniqid();

		# Company
		$data['company'] = $this->company;

		# Page Title
		$data['pageTitle'] = 'Compañía';

		# Tab
		$data['tab'] = 'settings';
		$data['subTab'] = 'company';

		return view(MAIN_ADMIN, $data);
	}

	public function saveCompanyInfo()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$response = array();
			$response['error'] = 2;
			$response['msg'] = 'SESSION_EXPIRED';

			return $response;
		}

		# Params
		$companyID = htmlspecialchars(trim($this->objRequest->getPost('companyID')));
		$name = htmlspecialchars(trim($this->objRequest->getPost('name')));
		$email = htmlspecialchars(trim($this->objRequest->getPost('email')));
		$phone = htmlspecialchars(trim($this->objRequest->getPost('phone')));
		$address1 = htmlspecialchars(trim($this->objRequest->getPost('address1')));
		$address2 = htmlspecialchars(trim($this->objRequest->getPost('address2')));
		$zip = htmlspecialchars(trim($this->objRequest->getPost('zip')));
		$country = htmlspecialchars(trim($this->objRequest->getPost('country')));

		$data = array();
		$data['companyID'] = $companyID;
		$data['name'] = $name;
		$data['email'] = $email;
		$data['phone'] = $phone;
		$data['address1'] = $address1;
		$data['address2'] = $address2;
		$data['zipCode'] = $zip;
		$data['country'] = $country;

		$response = $this->objMainModel->objUpdate('profile', $data, 1);

		return json_encode($response);
	}
}
