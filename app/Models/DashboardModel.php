<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
	protected $db;

	function  __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
	}

	public function getActiveClients()
	{
		$query = $this->db->table('customer')
			->where('deleted', 0);
		$data = $query->get()->getResult();

		return $data;
	}

	public function getActiveServices()
	{
		$query = $this->db->table('services')
			->where('deleted', 0);
		$data = $query->get()->getResult();

		return $data;
	}
}
