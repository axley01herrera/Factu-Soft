<?php

namespace App\Models;

use CodeIgniter\Model;

class TaxModel extends Model
{
	protected $db;

	function  __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
	}

	public function getTaxs()
	{
		$query = $this->db->table('tax');

		return $query->get()->getResult();
	}
}
