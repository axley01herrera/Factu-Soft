<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\ProfileModel;
use App\Models\DashboardModel;

class Dashboard extends BaseController
{
	protected $objSession;
	protected $objRequest;

	protected $objConfig;
	protected $objProfile;
	protected $objDashboardModel;

	protected $config;
	protected $profile;

	public function __construct()
	{
		$this->objSession = session();

		# Models
		$this->objConfig = new ConfigModel;
		$this->objProfile = new ProfileModel;
		$this->objDashboardModel = new DashboardModel;

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
		$data['dashboardActive'] = 'active';
		# page
		$data['page'] = 'dashboard/mainDashboard';
		# data cards
		$data['clients'] = $this->objDashboardModel->getActiveClients();
		$data['services'] = $this->objDashboardModel->getActiveServices();

		return view('layouts/main', $data);
	}
}
