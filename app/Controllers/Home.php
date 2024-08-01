<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\ProfileModel;

class Home extends BaseController
{
    protected $objSession;
    protected $objRequest;
    protected $objConfig;
    protected $objProfile;
    protected $config;

    public function __construct()
    {
        $this->objSession = session();
        # Clear Session
        $this->objSession->set('user', []);

        # Models
        $this->objConfig = new ConfigModel;
        $this->objProfile = new ProfileModel;

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
        # params
        $msg = $this->objRequest->getPostGet('session');

        $data = array();
        $data['msg'] = $msg;

        return view('home/mainHome', $data);
    }

    public function login()
    {
        # params
        $accessKey = $this->objRequest->getPost('accessKey');

        if (!empty($accessKey)) {
            $result = $this->objProfile->verifyAccessKey($accessKey);

            if ($result['error'] == 0) {
                # Create Session
                $session = array();
                $session['role'] = 'admin';

                $this->objSession->set('user', $session);
            }

            return json_encode($result);
        }
    }
}

