<?php

namespace App\Controllers;

use App\Models\ConfigModel;

class Profile extends BaseController
{
    protected $objSession;
    protected $objRequest;
    protected $objConfig;
    protected $config;

    public function __construct()
    {
        $this->objSession = session();

        # Models
        $this->objConfig = new ConfigModel;

        # Services
        $this->objRequest = \Config\Services::request();

        $this->config = $this->objConfig->getConfig();

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
        # menu
		$data['profileActive'] = 'active';
        # page
		$data['page'] = 'profile/mainProfile';

		return view('layouts/main', $data);
	}
}