<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\MainModel;
use App\Models\ProfileModel;
use App\Models\TaxModel;

class Taxs extends BaseController
{
	protected $objSession;
	protected $objRequest;

	protected $objConfig;
	protected $objProfile;
	protected $objMainModel;
	protected $objTaxsModel;

	protected $config;
	protected $profile;

	public function __construct()
	{
		$this->objSession = session();

		# Models
		$this->objConfig = new ConfigModel;
		$this->objProfile = new ProfileModel;
		$this->objMainModel = new MainModel;
		$this->objTaxsModel = new TaxModel;

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
		$data['taxs'] = $this->objTaxsModel->getTaxs();
		# menu
		$data['invoiceTaxsActive'] = 'active';
		# page
		$data['page'] = 'taxs/mainTaxs';

		return view('layouts/main', $data);
	}

	public function createTax()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		$data = array();
		$data['config'] = $this->config;
		$data['modalTitle'] = lang('Text.taxs_create_modal_title');

		return view('taxs/addEditModal', $data);
	}

	public function editTax()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		# Params
		$taxID = $this->objRequest->getPost('taxID');

		$tax = $this->objTaxsModel->getTaxs($taxID);

		$data = array();
		$data['config'] = $this->config;
		$data['taxID'] = $taxID;
		$data['tax'] = $tax;
		$data['modalTitle'] = $tax[0]->name;

		return view('taxs/addEditModal', $data);
	}

	public function saveTax()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";

			return json_encode($result);
		}

		# Params
		$taxID = $this->objRequest->getPost('taxID');
		$name = htmlspecialchars(trim($this->objRequest->getPost('name')));
		$description = htmlspecialchars(trim($this->objRequest->getPost('description')));
		$percent = htmlspecialchars(trim($this->objRequest->getPost('percent')));
		$operator = htmlspecialchars(trim($this->objRequest->getPost('operator')));

		$data = array();
		$data['name'] = $name;
		$data['description'] = $description;
		$data['percent'] = $percent;
		$data['operator'] = $operator;

		if (!empty($taxID)) // Case Update
			$result = $this->objMainModel->objUpdate('tax', $data, $taxID);

		else // Case Create
			$result = $this->objMainModel->objCreate('tax', $data);


		return json_encode($result);
	}
}
