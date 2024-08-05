<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
	protected $db;

	function  __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
	}

	public function getCustomer($customerID)
	{
		$query = $this->db->table('customer')
			->where('deleted', 0)
			->where('id', $customerID);

		$data = $query->get()->getResult();

		return $data;
	}
}
