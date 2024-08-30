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
            invoice.id as invoiceID,
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

		$invoices = $query->get()->getResult();

		$tHead = [];
		$tHead[] = lang('Text.table_reports_col_date');
		$tHead[] = lang('Text.table_reports_col_invoice_number');
		$tHead[] = lang('Text.table_reports_col_invoice_concept');
		$tHead[] = lang('Text.table_reports_col_tax_base');
		$tHead[] = lang('Text.table_reports_col_taxes_applied'); // New column for applied taxes
		$tHead[] = lang('Text.table_reports_col_amount');

		$tBody = [];

		foreach ($invoices as $i) {
			$row = [];
			$row[] = $i->date;               // Fecha de la factura
			$row[] = $i->invoiceNumber;      // Número de factura completo
			$row[] = $i->customer;           // Cliente
			$row[] = $i->tax_base;        	// Monto total

			$query_invoice_tax = $this->db->table('invoice_tax')
				->select('
                tax.description as tax,
                tax.percent as taxPercent
            ')
				->join('tax', 'tax.id = invoice_tax.tax_id')
				->where('invoice_id', $i->invoiceID);

			$invoice_tax = $query_invoice_tax->get()->getResult();

			$taxes_applied = [];

			foreach ($invoice_tax as $it) {
				$taxes_applied[] = $it->tax . ' ' . $it->taxPercent . '%'; // Collect tax information
			}

			// Add the taxes information as a single string in the new column
			$row[] = implode(', ', $taxes_applied);

			$row[] = $i->totalAmount;        // Importe
			$tBody[] = $row;
		}

		$data = array();
		$data['cols'] = $tHead;
		$data['rows'] = $tBody;

		return $data;
	}
}
