<?php

namespace App\Models;

use CodeIgniter\Model;

class TPVModel extends Model
{
	protected $db;

	function  __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
	}

	public function getOpenInvoice()
	{
		$query = $this->db->table('invoice')
			->where('status', 0);
		$data = $query->get()->getResult();

		return $data;
	}

	public function getTpvSerial()
	{
		$query = $this->db->table('serial')
			->where('id', 1);

		$data = $query->get()->getResult();

		return $data;
	}

	public function getInvoice($id)
	{
		$query = $this->db->table('invoice')
			->where('id', $id);

		$data = $query->get()->getResult();

		return $data;
	}

	public function getServices()
	{
		$query = $this->db->table('services')
			->where('deleted', 0)
			->orderBy('name');

		$data = $query->get()->getResult();

		return $data;
	}

	public function getService($id)
	{
		$query = $this->db->table('services')
			->where('id', $id);

		$data = $query->get()->getResult();

		return $data;
	}

	public function getInvoiceItems($invoiceID)
	{
		$query = $this->db->table('invoice_items')
			->where('invoice_id', $invoiceID);

		$data = $query->get()->getResult();

		return $data;
	}

	public function clearInvoiceItems($invoiceID)
	{
		$return = array();

		$query = $this->db->table('invoice_items')
			->where('invoice_id', $invoiceID)
			->delete();

		if ($query == true) {
			$return['error'] = 0;
			$return['msg'] = 'success';
		} else {
			$return['error'] = 0;
			$return['msg'] = 'error on delete record';
		}

		return $return;
	}

	public function getTpvTaxes()
	{
		$query = $this->db->table('tax')
			->where('tpv', 1);

		$data = $query->get()->getResult();

		return $data;
	}

	public function getInvoiceTax($invoiceID)
	{
		$query = $this->db->table('invoice_tax')
			->select('
			invoice_tax.id as itID,
			tax.id as taxID,
			tax.name as taxName,
			tax.description as taxDesc,
			tax.percent as taxPercent,
			tax.operator as taxOperator
			')
			->join('tax', 'tax.id = invoice_tax.tax_id')
			->where('invoice_id', $invoiceID);

		$data = $query->get()->getResult();

		return $data;
	}
}
