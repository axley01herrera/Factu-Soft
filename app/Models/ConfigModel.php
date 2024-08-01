<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfigModel extends Model
{
	protected $db;

	function  __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
	}

    public function getConfig() 
    {
        $query = $this->db->table('config');
        $data = $query->get()->getResult();

        return $data;
    }
}