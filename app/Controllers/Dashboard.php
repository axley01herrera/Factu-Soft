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
		$data['lang'] = $this->config[0]->lang;
		# menu
		$data['dashboardActive'] = 'active';
		# page
		$data['page'] = 'dashboard/mainDashboard';

		return view('layouts/main', $data);
	}

	public function collectionDay()
	{
		$collectionDay = 0;
		$items = $this->objDashboardModel->getCollectionDay();

		if (empty($items)) {
			$result = array();
			$result['collectionDay'] = getMoneyFormat($this->config[0]->currency, $collectionDay);
		} else {
			foreach ($items as $i) {
				$collectionDay += $i->amount;
			}
			$result = array();
			$result['collectionDay'] = getMoneyFormat($this->config[0]->currency, $collectionDay);
		}

		return json_encode($result);
	}

	public function customers()
	{
		$customers = $this->objDashboardModel->getCustomers();

		if (empty($customers)) {
			$result = array();
			$result['customers'] = 0;
		} else {
			$result = array();
			$result['customers'] = sizeof($customers);
		}

		return json_encode($result);
	}

	public function services()
	{
		$services = $this->objDashboardModel->getServices();

		if (empty($services)) {
			$result = array();
			$result['services'] = 0;
		} else {
			$result = array();
			$result['services'] = sizeof($services);
		}

		return json_encode($result);
	}

	public function chartMont()
	{
		# params
		$year = $this->request->getPostGet('year');

		if (empty($year))
			$year = date('Y');

		$data = array();
		$data['config'] = $this->config;
		$data['chartMont'] = $this->objDashboardModel->chartMont($year);

		return view('dashboard/chartMont', $data);
	}

	public function pendingInvoices()
	{
		$pendingInvoices = $this->objDashboardModel->getPendingInvoices();

		if (empty($pendingInvoices)) {
			$result = array();
			$result['pendingInvoices'] = 0;
		} else {
			$result = array();
			$result['pendingInvoices'] = sizeof($pendingInvoices);
		}

		return json_encode($result);
	}
}
