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
			<a target="_Blank" href="'. base_url('TPV/printTicket?invoiceID=').$result[$i]->invoiceID.'">
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

	public function index()
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
}
