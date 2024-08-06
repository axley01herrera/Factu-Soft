<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\ProfileModel;
use App\Models\MainModel;

class Config extends BaseController
{
	protected $objSession;
	protected $objRequest;

	protected $objConfig;
	protected $objProfile;
	protected $objMainModel;

	protected $config;
	protected $profile;

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
		$data['config'] = $this->config;
		# menu
		$data['configActive'] = "active";
		# page
		$data['page'] = 'config/mainConfig';

		return view('layouts/main', $data);
	}

	public function saveConfig()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";

			return json_encode($result);
		}

		# Params
		$lang = htmlspecialchars(trim($this->objRequest->getPost('lang')));
		$timezone = htmlspecialchars(trim($this->objRequest->getPost('timezone')));
		$currency = htmlspecialchars(trim($this->objRequest->getPost('currency')));

		$data = array();
		$data['lang'] = $lang;
		$data['timezone'] = $timezone;
		$data['currency'] = $currency;

		$result = $this->objMainModel->objUpdate('config', $data, 1);

		return json_encode($result);
	}
}
