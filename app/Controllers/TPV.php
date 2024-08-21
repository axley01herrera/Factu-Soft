<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\ProfileModel;
use App\Models\TPVModel;
use App\Models\MainModel;

class TPV extends BaseController
{
	protected $objSession;
	protected $objRequest;
	protected $objConfig;
	protected $objProfile;
	protected $objTPVModel;
	protected $objMainModel;
	protected $profile;
	protected $config;

	public function __construct()
	{
		$this->objSession = session();

		# Models
		$this->objConfig = new ConfigModel;
		$this->objProfile = new ProfileModel;
		$this->objTPVModel = new TPVModel;
		$this->objMainModel = new MainModel;

		# Services
		$this->objRequest = \Config\Services::request();
		$this->profile = $this->objProfile->getProfile();
		$this->config = $this->objConfig->getConfig();

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

		$basket = $this->objTPVModel->getOpenBasket();

		if (empty($basket)) {
			$data = array();
			$data['dateTime'] = '';
			$data['date'] = '';
			$createBasket = $this->objMainModel->objCreate('basket', $data);
			$basket = $this->objTPVModel->getBasket($createBasket['id']);
		}

		$data = array();
		$data['profile'] = $this->profile;
		$data['config'] = $this->config;
		# menu
		$data['TPVActive'] = 'active';
		# page
		$data['page'] = 'TPV/mainTPV';

		$data['services'] = $this->objTPVModel->getActiveServices();
		$data['basket'] = $basket;

		return view('layouts/main', $data);
	}

	public function dtBasket()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			return view('logout');
		}

		# Params
		$basketID = $this->objRequest->getPost('basketID');

		$data = array();
		$data['profile'] = $this->profile;
		$data['config'] = $this->config;

		$data['basket'] = $this->objTPVModel->getBasketServices($basketID);

		return view('TPV/dtBasket', $data);
	}

	public function addServiceToBasket()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";

			return json_encode($result);
		}

		# Params
		$basketID = $this->objRequest->getPost('basketID');
		$serviceID = $this->objRequest->getPost('serviceID');

		$amount = $this->objTPVModel->getActiveServices($serviceID)[0]->price;

		$data = array();
		$data['basketID'] = $basketID;
		$data['serviceID'] = $serviceID;
		$data['amount'] = $amount;
		$data['quantity'] = 1;

		$result = $this->objTPVModel->addServiceToBasket($data);

		return json_encode($result);
	}

	public function clearBasketService()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";

			return json_encode($result);
		}

		# Params
		$basketID = $this->objRequest->getPost('basketID');

		$result = $this->objTPVModel->clearBasketServices($basketID);

		return json_encode($result);
	}

	public function removeServiceFromBasket()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";

			return json_encode($result);
		}

		# params
		$basketServiceID = $this->objRequest->getPost('basketServiceID');

		return json_encode($this->objMainModel->objDelete('basket_service', $basketServiceID));
	}

	public function changeQuantity()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";

			return json_encode($result);
		}

		# params
		$quantity = $this->objRequest->getPost('quantity');
		$action = $this->objRequest->getPost('action');
		$serviceID = $this->objRequest->getPost('serviceID');
		$currentAmount = $this->objRequest->getPost('currentAmount');
		$basketServiceID = $this->objRequest->getPost('basketServiceID');
		$servicePrice = getService($serviceID)[0]->price;

		$result['error'] = 3;

		if ($action == 'add')
			$amount = $servicePrice * $quantity;

		if ($action == 'rest')
			$amount = $currentAmount - $servicePrice;

		if ($amount > 0)
			$result = $this->objMainModel->objUpdate('basket_service', array('quantity' => $quantity, 'amount' => $amount), $basketServiceID);

		return json_encode($result);
	}

	public function editPriceTPV()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";

			return json_encode($result);
		}

		# params
		$basketServiceID = $this->objRequest->getPost('basketServiceID');
		$serviceInfo = $this->objRequest->getPost('serviceInfo');

		$data = array();
		# data
		$data['basketServiceID'] = $basketServiceID;
		$data['serviceInfo'] = $serviceInfo;
		$data['uniqid'] = uniqid();

		return view('TPV/editPriceModal', $data);
	}

	public function editPriceProcessTPV()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";

			return json_encode($result);
		}

		# params
		$basketServiceID = $this->objRequest->getPost('basketServiceID');
		$newPrice = $this->objRequest->getPost('newPrice');

		return json_encode($this->objMainModel->objUpdate('basket_service', array('amount' => $newPrice), $basketServiceID));
	}

	public function saveInvoice()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";

			return json_encode($result);
		}

		# params
		$basketID = $this->objRequest->getPost('basketID');
		$payType = $this->objRequest->getPost('payType');

		$data = array();
		$data['status'] = 1;
		$data['date'] = date("Y-m-d");
		$data['dateTime'] = date("Y-m-d H:i:s");
		$data['payType'] = $payType;

		$result = $this->objMainModel->objUpdate('basket', $data, $basketID);

		return json_encode($result);
	}
}
