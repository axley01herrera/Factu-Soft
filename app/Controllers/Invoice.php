<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\DataTableModel;
use App\Models\InvoiceModel;
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
	protected $objInvoiceModel;

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
		$this->objInvoiceModel = new InvoiceModel;

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

	public function ticket()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		$data = array();
		$data['profile'] = $this->profile;
		$data['lang'] = $this->config[0]->lang;

		# menu
		$data['ticketActive'] = 'active';
		# page
		$data['page'] = 'invoice/ticket/mainTicket';

		return view('layouts/main', $data);
	}

	public function processingTickets()
	{
		$dataTableRequest = $_REQUEST;

		$params = array();
		$params['draw'] = $dataTableRequest['draw'];
		$params['start'] = $dataTableRequest['start'];
		$params['length'] = $dataTableRequest['length'];
		$params['search'] = $dataTableRequest['search']['value'];
		$params['sortColumn'] = $dataTableRequest['order'][0]['column'];
		$params['sortDir'] = $dataTableRequest['order'][0]['dir'];

		$row = array();
		$totalRecords = 0;

		$result = $this->objDataTableModel->getTicketsProcessingData($params);
		$totalRows = sizeof($result);

		for ($i = 0; $i < $totalRows; $i++) {
			$pay_type = "";

			if ($result[$i]->pay_type == 1)
				$pay_type = lang("Text.card");
			else if ($result[$i]->pay_type == 2)
				$pay_type = lang("Text.cash");

			$col = array();
			$col['number'] = $result[$i]->invoiceNumber;
			$col['pay_type'] = $pay_type;
			$col['added'] = $result[$i]->added;
			$col['amount'] = getMoneyFormat($this->config[0]->currency, $result[$i]->amount);
			$col['print'] = '
			<a target="_Blank" href="' . base_url('TPV/printTicket?invoiceID=') . $result[$i]->invoiceID . '">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
					<path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
					<path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
				</svg>
			</a>';

			$row[$i] =  $col;
		}

		if ($totalRows > 0)
			$totalRecords = $this->objDataTableModel->getTotalTickets($params);

		$data = array();
		$data['draw'] = $dataTableRequest['draw'];
		$data['recordsTotal'] = intval($totalRecords);
		$data['recordsFiltered'] = intval($totalRecords);
		$data['data'] = $row;

		return json_encode($data);
	}

	public function invoice()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		$data = array();
		$data['profile'] = $this->profile;
		$data['lang'] = $this->config[0]->lang;
		# menu
		$data['invoiceActive'] = 'active';
		# page
		$data['page'] = 'invoice/mainInvoice';

		return view('layouts/main', $data);
	}

	public function processingInvoice()
	{
		$dataTableRequest = $_REQUEST;

		$params = array();
		$params['draw'] = $dataTableRequest['draw'];
		$params['start'] = $dataTableRequest['start'];
		$params['length'] = $dataTableRequest['length'];
		$params['search'] = $dataTableRequest['search']['value'];
		$params['sortColumn'] = $dataTableRequest['order'][0]['column'];
		$params['sortDir'] = $dataTableRequest['order'][0]['dir'];

		$row = array();
		$totalRecords = 0;

		$result = $this->objDataTableModel->getInvoiceProcessingData($params);
		$totalRows = sizeof($result);

		for ($i = 0; $i < $totalRows; $i++) {
			$invoiceStatus = "";

			if ($result[$i]->invoiceStatus == 2)
				$invoiceStatus = '<span class="badge bg-secondary-subtle text-secondary">' . lang('Text.inv_status_draft') . '</span>';
			else if ($result[$i]->invoiceStatus == 3)
				$invoiceStatus = '<span class="badge bg-warning-subtle text-warning">' . lang('Text.inv_status_pending') . '</span>';

			$col = array();
			$col['status'] = $invoiceStatus;
			$col['number'] = $result[$i]->invoiceNumber;
			$col['added'] = $result[$i]->added;
			$col['amount'] = getMoneyFormat($this->config[0]->currency, $result[$i]->amount);
			$col['action'] = '';

			$row[$i] =  $col;
		}

		if ($totalRows > 0)
			$totalRecords = $this->objDataTableModel->getTotalInvoice($params);

		$data = array();
		$data['draw'] = $dataTableRequest['draw'];
		$data['recordsTotal'] = intval($totalRecords);
		$data['recordsFiltered'] = intval($totalRecords);
		$data['data'] = $row;

		return json_encode($data);
	}

	public function createInvoice()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		$d = array();
		$d['status'] = 2; // DRAFT
		$d['type'] = 2;
		$d['added'] = date('Y-m-d H:i:s');
		$d['updated'] = date('Y-m-d H:i:s');

		$rs = $this->objMainModel->objCreate('invoice', $d);

		return redirect()->to(base_url('Invoice/editInvoice?id=') . $rs['id']);
	}

	public function editInvoice()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		$invoiceID = $this->objRequest->getPostGet('id');

		$data = array();
		$data['config'] = $this->config;
		$data['profile'] = $this->profile;
		$data['lang'] = $this->config[0]->lang;
		$data['invoiceID'] = $invoiceID;
		$data['invoice'] = $this->objInvoiceModel->getInvoice($invoiceID);
		$data['customers'] = $this->objInvoiceModel->getSelCustomers();

		if ($data['invoice'][0]->status == 2)
			$data['status'] = '<span class="badge bg-secondary-subtle text-secondary">' . lang('Text.inv_status_draft') . '</span>';

		if (!empty($data['invoice'][0]->customer))
			$data['customer'] = $this->objInvoiceModel->getCustomer($data['invoice'][0]->customer);

		$data['items'] = $this->objInvoiceModel->getInvoiceItems($invoiceID);

		# menu
		$data['invoiceActive'] = 'active';
		# page
		$data['page'] = 'invoice/editInvoice';

		return view('layouts/main', $data);
	}

	public function addLineItem()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		# params
		$invoiceID = $this->objRequest->getPost('invoiceID');

		$data = array();
		$data['modalTitle'] = lang('Text.inv_new_invoice_line');
		$data['invoiceID'] = $invoiceID;
		$data['services'] = $this->objInvoiceModel->getSelServices();
		$data['config'] = $this->config;

		return view('invoice/addInvoiceLine', $data);
	}

	public function addLineItemProcess()
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
		$desc = htmlspecialchars(trim($this->objRequest->getPost('desc')));
		$qty = htmlspecialchars(trim($this->objRequest->getPost('qty')));
		$price = htmlspecialchars(trim($this->objRequest->getPost('price')));
		$serviceID = $this->objRequest->getPost('serviceID');

		$d = array();
		$d['invoice_id'] = $invoiceID;
		$d['service_id'] = $serviceID;
		$d['description'] = $desc;
		$d['quantity'] = $qty;
		$d['amount'] = $qty * $price;

		$rs = $this->objMainModel->objCreate('invoice_items', $d);

		return json_encode($rs);
	}

	public function removeItem()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";
			return json_encode($result);
		}

		# params
		$id = $this->objRequest->getPost('itemID');

		return json_encode($this->objMainModel->objDelete('invoice_items', $id));
	}

	public function issueInvoice()
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
		$customerID = $this->objRequest->getPost('customerID');

		$customer = $this->objInvoiceModel->getCustomer($customerID);
		$serial = $this->objInvoiceModel->getSerial($customer[0]->serial_id);

		$consecutive = $serial[0]->count + 1;

		$d = array();
		$d['serie'] = $customer[0]->serial_id;
		$d['status'] = 3;
		$d['number'] = $serial[0]->name . str_pad($consecutive, STR_PAD_LEFT_NUMBER, '0', STR_PAD_LEFT);
		$d['added'] = date('Y-m-d H:i:s');
		$d['updated'] = date('Y-m-d H:i:s');

		$this->objMainModel->objUpdate('invoice', $d, $invoiceID);

		$d = array();
		$d['count'] = $consecutive;
		$d['updated'] = date('Y-m-d H:i:s');

		$this->objMainModel->objUpdate('serial', $d, $serial[0]->id);

		$result = array();
		$result['error'] = 0;
		$result['invoiceID'] = $invoiceID;

		return json_encode($result);
	}

	public function objUpdateInvoice()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$result = array();
			$result['error'] = 2;
			$result['msg'] = "SESSION_EXPIRED";
			return json_encode($result);
		}

		# params
		$field = $this->objRequest->getPost('field');
		$value = $this->objRequest->getPost('value');
		$invoiceID = $this->objRequest->getPost('invoiceID');

		$rs = $this->objMainModel->objUpdate('invoice', [$field => $value], $invoiceID);

		return json_encode($rs);
	}

	public function processingInvoices()
	{
		$dataTableRequest = $_REQUEST;

		$params = array();
		$params['draw'] = $dataTableRequest['draw'];
		$params['start'] = $dataTableRequest['start'];
		$params['length'] = $dataTableRequest['length'];
		$params['search'] = $dataTableRequest['search']['value'];
		$params['sortColumn'] = $dataTableRequest['order'][0]['column'];
		$params['sortDir'] = $dataTableRequest['order'][0]['dir'];

		$row = array();
		$totalRecords = 0;

		$result = $this->objDataTableModel->getInvoicesProcessingData($params);
		$totalRows = sizeof($result);

		$dateFormat = 'm-d-Y';

		if ($this->config[0]->lang == 'es')
			$dateFormat = 'd-m-Y';

		for ($i = 0; $i < $totalRows; $i++) {
			$col = array();
			$col['invoiceID'] = $result[$i]->invoiceID;
			$col['invoiceNumber'] = str_pad($result[$i]->invoiceNumber, STR_PAD_LEFT_NUMBER, '0', STR_PAD_LEFT);
			$col['created'] = date($dateFormat, strtotime($result[$i]->created));
			$col['due_date'] = date($dateFormat, strtotime($result[$i]->due_date));
			$col['invoiceStatus'] = '<span class="badge bg-primary-subtle text-primary">' . lang('Text.invoices_dt_status_open') . '</span>';
			if ($result[$i]->invoiceStatus == 1)
				$col['invoiceStatus'] = '<span class="badge bg-primary-subtle text-primary">' . lang('Text.invoices_dt_status_paid') . '</span>';
			$row[$i] =  $col;
		}

		if ($totalRows > 0)
			$totalRecords = $this->objDataTableModel->getTotalInvoices($params);

		$data = array();
		$data['draw'] = $dataTableRequest['draw'];
		$data['recordsTotal'] = intval($totalRecords);
		$data['recordsFiltered'] = intval($totalRecords);
		$data['data'] = $row;

		return json_encode($data);
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

	public function print()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		$invoiceID = $this->objRequest->getPostGet('id');

		$data = array();
		$data['config'] = $this->config;
		$data['profile'] = $this->profile;
		$data['lang'] = $this->config[0]->lang;
		$data['invoice'] = $this->objInvoiceModel->getInvoice($invoiceID);
		$data['items'] = $this->objInvoiceModel->getInvoiceItems($invoiceID);
		$data['customer'] = $this->objInvoiceModel->getCustomer($data['invoice'][0]->customer);

		return view('invoice/print', $data);
	}
}
