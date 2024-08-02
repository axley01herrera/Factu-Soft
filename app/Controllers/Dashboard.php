<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\ProfileModel;

class Dashboard extends BaseController
{
	protected $objSession;
	protected $objRequest;
	protected $objConfig;
	protected $objProfile;
	protected $config;
	protected $company;

	public function __construct()
	{
		$this->objSession = session();

		# Models
		$this->objConfig = new ConfigModel;
		$this->objProfile = new ProfileModel;

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

	public function index()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		$data = array();

		# Company
		$data['company'] = $this->company;

		# Page
		$data['pageTitle'] = 'Tablero';
		$data['page'] = 'admin/dashboard/mainDashboard';

		# Tab
		$data['tab'] = 'dashboard';

		return view(MAIN_ADMIN, $data);
	}
}
