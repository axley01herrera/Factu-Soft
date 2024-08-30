<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\MainModel;
use App\Models\ProfileModel;
use App\Models\ReportModel;

class Reports extends BaseController
{
	protected $objSession;
	protected $objRequest;

	protected $objConfig;
	protected $objProfile;
	protected $objMainModel;
	protected $objReportModel;

	protected $config;
	protected $profile;

	public function __construct()
	{
		$this->objSession = session();

		# Models
		$this->objConfig = new ConfigModel;
		$this->objProfile = new ProfileModel;
		$this->objMainModel = new MainModel;
		$this->objReportModel = new ReportModel;

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
		$data['selFilterSerial'] = $this->objReportModel->selFilterSerial();
		# menu
		$data['reportsActive'] = 'active';
		# page
		$data['page'] = 'reports/mainReports';

		return view('layouts/main', $data);
	}

	public function getReports()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		# Params
		$dateStart = htmlspecialchars(trim($this->objRequest->getPost('dateStart')));
		$dateEnd = htmlspecialchars(trim($this->objRequest->getPost('dateEnd')));
		$series = $this->objRequest->getPost('series');

		$data = array();
		$data['config'] = $this->config;
		$data['lang'] = $this->config[0]->lang;
		$data['data'] = $this->objReportModel->getReports($dateStart, $dateEnd, $series);

		return view('reports/reportsDT', $data);
	}

	public function printReport()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');
	}
}
