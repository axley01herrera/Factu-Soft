<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\ProfileModel;

class Config extends BaseController
{
    protected $objSession;
    protected $objRequest;

    protected $objConfig;
    protected $objProfile;

    protected $config;
    protected $profile;

    public function __construct()
    {
        $this->objSession = session();

        # Models
        $this->objConfig = new ConfigModel;
        $this->objProfile = new ProfileModel;

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
    }

    public function index()
    {
        # Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('logout');

        $data = array();
        $data['profile'] = $this->profile;
        $data['config'] = $this->config;
        # menu
        $data['configActive'] = "active";
        # page
		$data['page'] = 'config/mainConfig';

        return view('layouts/main', $data);
    }
}
