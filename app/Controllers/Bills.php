<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\ProfileModel;
use App\Models\BillsModel;
use App\Models\MainModel;
use App\Models\DataTableModel;

class Bills extends BaseController
{
	protected $objSession;
	protected $objRequest;

	protected $objConfig;
	protected $objProfile;
	protected $objBillsModel;
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
		$this->objBillsModel = new BillsModel;
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

	public function uploadFiles()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		$data = array();
		$data['config'] = $this->config;
		$data['profile'] = $this->profile;
		$data['lang'] = $this->config[0]->lang;
		# menu
		$data['uploadFileActive'] = 'active';
		# page
		$data['page'] = 'bills/uploadFiles';

		return view('layouts/main', $data);
	}

	public function fileList()
	{
		# Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
			return view('logout');

		$data = array();
		$data['config'] = $this->config;
		$data['profile'] = $this->profile;
		$data['lang'] = $this->config[0]->lang;
		$data['files'] = $this->objBillsModel->getFiles();
		# menu
		$data['fileListActive'] = 'active';
		# page
		$data['page'] = 'bills/fileList';

		return view('layouts/main', $data);
	}

	public function uploadFilesProccess()
	{
		# Verify Assist Session
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$response = array();
			$response['error'] = 2;
			$response['msg'] = 'SESSION_EXPIRED';

			return json_encode($response);
		}

		helper('filesystem');

		$files = $_FILES['files'];
		$date = $_POST['date'];

		$folder = 'upload/bills/' . $date . '/';
		$invalidExtensions = array('php', 'js', 'html', 'css');

		$path = 'upload/bills/' . $date . '/';
		$realPath = realpath($path);

		if ($realPath !== false && file_exists($realPath)) {
		} else {
			set_realpath($path);
			mkdir($path, 0777, true);
		}

		$result = array();
		$result['error'] = 1;

		foreach ($files['name'] as $index => $fileName) {
			$tmp = $files['tmp_name'][$index];

			$ext = pathinfo($fileName, PATHINFO_EXTENSION);
			$name = $fileName;

			if (!in_array(strtolower($ext), $invalidExtensions)) {
				$path = $folder . '' . $name;
				move_uploaded_file($tmp, $path);
			}

			$data = array();
			$data['fileName'] = $fileName;
			$data['path'] = $path;
			$data['date'] = $date;

			$result = $this->objMainModel->objCreate('files', $data);
		}

		return json_encode($result);
	}

	public function deleteUploadFile()
	{
		# Verify Assist Session
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
			$response = array();
			$response['error'] = 2;
			$response['msg'] = 'SESSION_EXPIRED';

			return json_encode($response);
		}

		# Params
		$fileID = $this->objRequest->getPost('fileID');
		$path = $this->objRequest->getPost('path');

		if (file_exists($path))
			unlink($path);

		$result = $this->objMainModel->objDelete('files', $fileID);

		return json_encode($result);
	}

	public function proccesingFilesDT()
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

		$result = $this->objDataTableModel->getFilesProcessingData($params);
		$totalRows = sizeof($result);

		for ($i = 0; $i < $totalRows; $i++) {

			$col = array();
			$col['filename'] = $result[$i]->filename;
			$col['date'] = date('d-m-Y', strtotime($result[$i]->date));
			$col['action'] = '
			<a class="me-2" href="' . base_url("public/" . "" . $result[$i]->path) . '" download>
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-download">
					<path stroke="none" d="M0 0h24v24H0z" fill="none" />
					<path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
					<path d="M7 11l5 5l5 -5" />
					<path d="M12 4l0 12" />
				</svg>
			</a>
			<a class="me-2 delete-file" href="#" data-file-id="' . $result[$i]->id . '" data-file-path="' . $result[$i]->path . '">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
					<path stroke="none" d="M0 0h24v24H0z" fill="none" />
					<path d="M4 7l16 0" />
					<path d="M10 11l0 6" />
					<path d="M14 11l0 6" />
					<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
					<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
				</svg>
			</a>';

			$row[$i] =  $col;
		}

		if ($totalRows > 0)
			$totalRecords = $this->objDataTableModel->getTotalFiles($params);

		$data = array();
		$data['draw'] = $dataTableRequest['draw'];
		$data['recordsTotal'] = intval($totalRecords);
		$data['recordsFiltered'] = intval($totalRecords);
		$data['data'] = $row;

		return json_encode($data);
	}
}
