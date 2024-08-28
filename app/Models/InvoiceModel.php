<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
	protected $db;

	function  __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
	}

	public function getInvoice($id)
	{
		$query = $this->db->table('invoice')
			->where('id', $id);

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

	public function getSelCustomers()
	{
		$query = $this->db->table('customer');
		$data = $query->get()->getResult();
		return $data;
	}

	public function getSelTax()
	{
		$query = $this->db->table('tax');
		$data = $query->get()->getResult();
		return $data;
	}

	public function getCustomer($id)
	{
		$query = $this->db->table('customer')
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

	public function getSelServices()
	{
		$query = $this->db->table('services')
			->where('deleted', 0);

		$data = $query->get()->getResult();

		return $data;
	}

	public function getSerial($id)
	{
		$query = $this->db->table('serial')
			->where('id', $id);

		$data = $query->get()->getResult();

		return $data;
	}

	public function deleteInvoice($invoiceID)
	{
		$return = array();

		$query = $this->db->table('invoice')
			->where('id', $invoiceID)
			->delete();

		if ($query == true) {
			$return['error'] = 0;
			$return['msg'] = 'success';
		} else {
			$return['error'] = 1;
			$return['msg'] = 'error on delete record';
		}

		return $return;
	}

	public function deleteInvoiceItems($invoiceID)
	{
		$return = array();

		$query = $this->db->table('invoice_items')
			->where('invoice_id', $invoiceID)
			->delete();

		if ($query == true) {
			$return['error'] = 0;
			$return['msg'] = 'success';
		} else {
			$return['error'] = 1;
			$return['msg'] = 'error on delete record';
		}

		return $return;
	}

	public function payInvoice($invoiceID, $data)
	{
		$query = $this->db->table('invoice')
			->where('id', $invoiceID)
			->update($data);

		$result = array();

		if ($query == true) {
			$result['error'] = 0;
			$result['id'] = $invoiceID;
		} else {
			$result['error'] = 1;
		}

		return $result;
	}

	public function checkExistSerialName($serialName)
	{
		$query = $this->db->table('serial')
			->where('name', $serialName);

		$data = $query->get()->getResult();

		return $data;
	}
}
