<?php

namespace App\Models;

use CodeIgniter\Model;

class BillsModel extends Model
{
	protected $db;

	function  __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
	}

	public function getFiles()
	{
		$query = $this->db->table('files');
		$data = $query->get()->getResult();

		return $data;
	}
}
