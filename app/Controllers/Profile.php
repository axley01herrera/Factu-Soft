<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\MainModel;
use App\Models\ProfileModel;

class Profile extends BaseController
{
    protected $objSession;
    protected $objRequest;
    protected $objConfig;
    protected $objProfile;
    protected $objMainModel;
    protected $config;

    public function __construct()
    {
        $this->objSession = session();

        # Models
        $this->objConfig = new ConfigModel;
        $this->objProfile = new ProfileModel;
        $this->objMainModel = new MainModel;
        
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

        $profile = $this->objProfile->getProfile();

		$data = array();
        $data['profile'] = $profile;
        # menu
		$data['profileActive'] = 'active';
        # page
		$data['page'] = 'profile/mainProfile';

		return view('layouts/main', $data);
	}

    public function updateProfile() 
    {
        # Verify Session 
		if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }
            
        # params
        $name = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $company_id = htmlspecialchars(trim($this->objRequest->getPost('company_id')));
        $email = htmlspecialchars(trim($this->objRequest->getPost('email')));
        $phone = htmlspecialchars(trim($this->objRequest->getPost('phone')));
        $address_a = htmlspecialchars(trim($this->objRequest->getPost('address_a')));
        $city = htmlspecialchars(trim($this->objRequest->getPost('city')));
        $state = htmlspecialchars(trim($this->objRequest->getPost('state')));
        $zip = htmlspecialchars(trim($this->objRequest->getPost('zip')));
        $country = htmlspecialchars(trim($this->objRequest->getPost('country')));
        $description = htmlspecialchars(trim($this->objRequest->getPost('description')));

        $data = array();
        $data['name'] = $name;
        $data['company_id'] = $company_id;
        $data['email'] = $email;
        $data['phone'] = $phone;
        $data['address_a'] = $address_a;
        $data['city'] = $city;
        $data['state'] = $state;
        $data['zip'] = $zip;
        $data['country'] = $country;
        $data['description'] = $description;

        $result = $this->objMainModel->objUpdate('profile', $data, 1);

        return json_encode($result);
    }
}