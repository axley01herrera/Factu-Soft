<?php

namespace App\Controllers;

use App\Models\ConfigModel;

class Company extends BaseController
{
	protected $objSession;
	protected $objRequest;
	protected $objConfig;
	protected $config;

	public function __construct()
	{
		$this->objSession = session();

		# Models
		$this->objConfig = new ConfigModel;

		# Services
		$this->objRequest = \Config\Services::request();

		$this->config = $this->objConfig->getConfig();

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

		# Page Title
		$data['pageTitle'] = 'Compañía';

		# Tab
		$data['tab'] = 'settings';
		$data['subTab'] = 'company';

		return view(MAIN_ADMIN, $data);
	}
}
