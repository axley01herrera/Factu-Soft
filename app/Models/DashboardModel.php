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

	public function getCollectionDay()
	{
		$query = $this->db->table('invoice')
		->select('invoice_items.amount as amount')
		->where("DATE(added)", date('Y-m-d'))
		->join('invoice_items', "invoice_items.invoice_id = invoice.id");

		$data = $query->get()->getResult();

		return $data;
	}

	public function getCustomers()
	{
		$query = $this->db->table('customer')
			->where('deleted', 0);
		$data = $query->get()->getResult();

		return $data;
	}

	public function getServices()
	{
		$query = $this->db->table('services')
			->where('deleted', 0);
		$data = $query->get()->getResult();

		return $data;
	}
}
