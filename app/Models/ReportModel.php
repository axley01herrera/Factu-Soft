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
		$start = date('Y-m-d', strtotime($dateStart)) . ' 00:00:00';
		$end = date('Y-m-d', strtotime($dateEnd)) . ' 23:59:59';

		$query = $this->db->table('invoice')
			->select('
				invoice.number as invoiceNumber,
				invoice.type as invoiceType,
				invoice.pay_type as payType,
				invoice.added as date,
				SUM(invoice_items.amount) as totalAmount
			')
			->join('invoice_items', "invoice_items.invoice_id = invoice.id", 'left')
			->where('status != 2')
			->where("added >=", $start)
			->where("added <=", $end)
			->orderBy('added', 'ASC')
			->groupBy('invoice.id');

		$data = $query->get()->getResult();

		return $data;
	}
}
