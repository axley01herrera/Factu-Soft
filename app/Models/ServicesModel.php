<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicesModel extends Model
{
	protected $db;

	function  __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
	}

	public function getServices($serviceID = null)
	{
		$query = $this->db->table('services')
			->where('deleted', 0);

		if (!empty($serviceID))
			$query->where('id', $serviceID);

		$data = $query->get()->getResult();

		return $data;
	}
}
