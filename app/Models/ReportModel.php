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

	public function selFilterSerial() 
	{
		$query = $this->db->table('serial s')
		->select('
		s.id AS serialID,
		s.name AS serialName,
		c.name As customer
		')
		->join('customer c', 'c.serial_id = s.id', 'left');

		$data = $query->get()->getResult();

		return $data;
	}

	public function getReports($dateStart, $dateEnd, $series)
	{
		$start = date('Y-m-d', strtotime($dateStart)) . ' 00:00:00';
		$end = date('Y-m-d', strtotime($dateEnd)) . ' 23:59:59';

		$query = $this->db->table('invoice')
			->select('
				invoice.serie as serie,
				invoice.number as invoiceNumber,
				invoice.type as invoiceType,
				invoice.pay_type as payType,
				invoice.added as date,
				invoice.total_amount as totalAmount,
				customer.name as customer
			')
			->join('customer', 'customer.id = invoice.customer', 'left')
			->where('status != 2')
			->where("invoice.added >=", $start)
			->where("invoice.added <=", $end)
			->orderBy('invoice.added', 'ASC');

		if (!empty($series)) {
			$query->whereIn('invoice.serie', $series);
		}

		$data = $query->get()->getResult();

		return $data;
	}
}
