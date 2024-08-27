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
		$query = $this->db->table('dt_invoices');

		if (empty($dateEnd)) { // CASE DAY
			$query->where('added', $dateStart);
		} else { // CASE RANGE DAYS
			$query->where('added >=', $dateStart);
			$query->where('added <=', $dateEnd);
		}

		$query->orderBy('added', 'ASC');

		return $query->get()->getResult();
	}
}
