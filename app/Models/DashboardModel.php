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
			->where("invoice.status !=2")
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

	public function chartMont($year)
	{
		$firstDay = "$year-01-01 00:00:00";
		$lastDay = "$year-12-31 23:59:59";

		$query = $this->db->table('invoice')
			->select('SUM(invoice_items.amount) as totalPrice, MONTH(invoice.added) as month, status')
			->join('invoice_items', "invoice_items.invoice_id = invoice.id", 'left')
			->where("invoice.added >=", $firstDay)
			->where("invoice.added <=", $lastDay)
			->groupStart()
			->where("invoice.status !=2")
			->groupEnd()
			->groupBy('MONTH(invoice.added)');

		$data = $query->get()->getResult();
		
		$serie = array_fill(1, 12, 0);
		$total = 0;

		foreach ($data as $row) {
			$month = (int) $row->month;
			$serie[$month] = (float) $row->totalPrice;
			$total += $serie[$month];
		}

		$serie['total'] = $total;

		return $serie;
	}
}
