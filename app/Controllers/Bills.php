<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\ProfileModel;
use App\Models\BillsModel;
use App\Models\MainModel;

class Bills extends BaseController
{
	protected $objSession;
	protected $objRequest;

	protected $objConfig;
	protected $objProfile;
	protected $objBillsModel;
	protected $objMainModel;

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
}
