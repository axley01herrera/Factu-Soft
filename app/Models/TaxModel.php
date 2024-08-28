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

	public function getTaxs($taxID = null)
	{
		$query = $this->db->table('tax');

		if (!empty($taxID))
			$query->where('id', $taxID);

		return $query->get()->getResult();
	}
}
