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

		$invoice = $this->objTPVModel->getOpenInvoice();

		if (empty($invoice)) {
			$serial = $this->objTPVModel->getTpvSerial();

			$d = array();
			$d['serie'] = $serial[0]->id;
			$d['number'] = $serial[0]->count + 1;
			$d['created_date'] = date('Y-m-d');
			$d['added'] = date('Y-m-d H:i:s');
			$d['updated'] = date('Y-m-d H:i:s');

			$rsInvoice = $this->objMainModel->objCreate('invoice', $d);

			$d = array();
			$d['count'] = $serial[0]->count + 1;
			$d['updated'] = date('Y-m-d H:i:s');

			$this->objMainModel->objUpdate('serial', $d, $serial[0]->id);
			$invoice = $this->objTPVModel->getInvoice($rsInvoice['id']);
		}

		$data = array();
		$data['profile'] = $this->profile;
		$data['config'] = $this->config;
		# menu
		$data['tpvActive'] = 'active';
		# page
		$data['page'] = 'TPV/mainTPV';

		$data['services'] = $this->objTPVModel->getServices();
		$data['invoice'] = $invoice;

		return view('layouts/main', $data);
	}

	public function invoiceItems()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			return view('logout');
		}

		# Params
		$invoiceID = $this->objRequest->getPost('invoiceID');

		$data = array();
		$data['config'] = $this->config;
		$data['items'] = $this->objTPVModel->getInvoiceItems($invoiceID);

		return view('TPV/items', $data);
	}

	public function addInvoiceItem()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";
			return json_encode($result);
		}

		# Params
		$invoiceID = $this->objRequest->getPost('invoiceID');
		$serviceID = $this->objRequest->getPost('serviceID');

		$service = $this->objTPVModel->getService($serviceID);
		$amount = $service[0]->price;

		$d = array();
		$d['invoice_id'] = $invoiceID;
		$d['service_id'] = $serviceID;
		$d['amount'] = $amount;
		$d['quantity'] = 1;

		$result = $this->objMainModel->objCreate('invoice_items', $d);

		return json_encode($result);
	}

	public function clearInvoiceItems()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";
			return json_encode($result);
		}

		# Params
		$invoiceID = $this->objRequest->getPost('invoiceID');

		$result = $this->objTPVModel->clearInvoiceItems($invoiceID);

		return json_encode($result);
	}

	public function removeInvoiceItem()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";
			return json_encode($result);
		}

		# params
		$id = $this->objRequest->getPost('id');

		return json_encode($this->objMainModel->objDelete('invoice_items', $id));
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
		$invoiceItemsID = $this->objRequest->getPost('invoiceItemsID');
		$servicePrice = getService($serviceID)[0]->price;

		$result['error'] = 3;

		if ($action == 'add')
			$amount = $servicePrice * $quantity;

		if ($action == 'rest')
			$amount = $currentAmount - $servicePrice;

		if ($amount > 0)
			$result = $this->objMainModel->objUpdate('invoice_items', array('quantity' => $quantity, 'amount' => $amount), $invoiceItemsID);

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
		$invoiceItemsID = $this->objRequest->getPost('invoiceItemsID');
		$serviceInfo = $this->objRequest->getPost('serviceInfo');

		$data = array();
		# data
		$data['invoiceItemsID'] = $invoiceItemsID;
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
		$invoiceItemsID = $this->objRequest->getPost('invoiceItemsID');
		$newPrice = $this->objRequest->getPost('newPrice');

		return json_encode($this->objMainModel->objUpdate('invoice_items', array('amount' => $newPrice), $invoiceItemsID));
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
		$invoiceID = $this->objRequest->getPost('invoiceID');
		$payType = $this->objRequest->getPost('payType');

		$d = array();
		$d['status'] = 1;
		$d['pay_type'] = $payType;
		$d['updated'] = date('Y-m-d H:i:s');

		$result = $this->objMainModel->objUpdate('invoice', $d, $invoiceID);

		return json_encode($result);
	}

	public function printTicket()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";

			return json_encode($result);
		}

		# params
		$invoiceID = $this->objRequest->getPostGet('invoiceID');

		$invoice = $this->objTPVModel->getInvoice($invoiceID);
		$items = $this->objTPVModel->getInvoiceItems($invoiceID);

		$data = array();
		# config
		$data['config'] = $this->config;
		$data['profile'] = $this->profile;
		# data 
		$data['invoice'] = $invoice;
		$data['items'] = $items;

		return view('TPV/ticket', $data);
	}
}
