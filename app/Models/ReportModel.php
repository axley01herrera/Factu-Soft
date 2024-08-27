<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
	protected $db;

	function  __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
	}

	public function getCustomers()
	{
		$query = $this->db->table('customer')
			->where('deleted', 0);

		return $query->get()->getResult();
	}

	public function getReports($dateStart, $dateEnd)
	{
		$query = $this->db->table('dt_invoices')
		->where('invoiceStatus!=', 2);

		if (empty($dateEnd)) { // CASE DAY
			$query->where('DATE(added)', $dateStart);
		} else { // CASE RANGE DAYS
			$query->where('DATE(added) >=', $dateStart);
			$query->where('DATE(added) <=', $dateEnd);
		}

		$query->orderBy('added', 'ASC');

		return $query->get()->getResult();
	}
}
