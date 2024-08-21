<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\DataTableModel;
use App\Models\MainModel;
use App\Models\ProfileModel;

class Invoice extends BaseController
{
	protected $objSession;
	protected $objRequest;

	protected $objConfig;
	protected $objProfile;
	protected $objMainModel;
	protected $objDataTableModel;

	protected $config;
	protected $profile;

	public function __construct()
	{
		$this->objSession = session();

		# Models
		$this->objConfig = new ConfigModel;
		$this->objProfile = new ProfileModel;
		$this->objMainModel = new MainModel;
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
		$data['invoiceActive'] = 'active';
		# page
		$data['page'] = 'invoice/mainInvoice';

		return view('layouts/main', $data);
	}

	public function series()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		$series = $this->objDataTableModel->getSerials();

		$data = array();
		$data['profile'] = $this->profile;
		$data['lang'] = $this->config[0]->lang;
		$data['series'] = $series;
		# menu
		$data['invoiceSeriesActive'] = 'active';
		# page
		$data['page'] = 'invoice/serie/mainSerie';

		return view('layouts/main', $data);
	}

	public function createSerie()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		$data = array();
		$data['modalTitle'] = lang('Text.inv_new_serial');

		return view('invoice/serie/createSerie', $data);
	}

	public function createSerieProcess()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";

			return json_encode($result);
		}

		$name = htmlspecialchars(trim($this->objRequest->getPost('name')));

		$data = array();
		$data['name'] = strtoupper($name);
		$data['count'] = 0;
		$data['created'] = date('Y-m-d H:i:s');
		$data['updated'] = date('Y-m-d H:i:s');

		$result = $this->objMainModel->objCreate('serial', $data);

		return json_encode($result);
	}
}
