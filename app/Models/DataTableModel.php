<?php

namespace App\Models;

use CodeIgniter\Model;

class DataTableModel extends Model
{
	protected $db;

	function  __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
	}

	####################
	#### Customers Data Table
	####################

	public function getCustomersProcessingData($params)
	{
		$query = $this->db->table('customer');

		if (!empty($params['search'])) {
			$query->groupStart();
			$query->like('customer.name', $params['search']);
			$query->orLike('customer.last_name', $params['search']);
			$query->orLike('customer.nif', $params['search']);
			$query->orLike('customer.email', $params['search']);
			$query->orLike('customer.phone', $params['search']);
			$query->groupEnd();
		}

		$query->groupStart();
		$query->where('customer.deleted', 0);
		$query->groupEnd();

		$query->offset($params['start']);
		$query->limit($params['length']);
		$query->orderBy($this->getCustomerProcessingSort($params['sortColumn'], $params['sortDir']));

		$data = $query->get()->getResult();

		return $data;
	}

	public function getCustomerProcessingSort($column, $dir)
	{
		$sort = '';

		if ($column == 0) {
			if ($dir == 'asc')
				$sort = 'customer.type ASC';
			else
				$sort = 'customer.type DESC';
		}

		if ($column == 1) {
			if ($dir == 'asc')
				$sort = 'customer.name ASC';
			else
				$sort = 'customer.name DESC';
		}


		if ($column == 3) {
			if ($dir == 'asc')
				$sort = 'customer.email ASC';
			else
				$sort = 'customer.email DESC';
		}

		if ($column == 4) {
			if ($dir == 'asc')
				$sort = 'customer.phone ASC';
			else
				$sort = 'customer.phone DESC';
		}

		if ($column == 5) {
			if ($dir == 'asc')
				$sort = 'customer.updated ASC';
			else
				$sort = 'customer.updated DESC';
		}

		if ($column == 6) {
			if ($dir == 'asc')
				$sort = 'customer.added ASC';
			else
				$sort = 'customer.added DESC';
		}
		return $sort;
	}

	public function getTotalCustomers($params)
	{
		$query = $this->db->table('customer');

		if (!empty($params['search'])) {
			$query->groupStart();
			$query->like('customer.name', $params['search']);
			$query->orLike('customer.last_name', $params['search']);
			$query->orLike('customer.nif', $params['search']);
			$query->orLike('customer.email', $params['search']);
			$query->orLike('customer.phone', $params['search']);
			$query->groupEnd();
		}

		$query->groupStart();
		$query->where('customer.deleted', 0);
		$query->groupEnd();

		return $query->countAllResults();
	}

	####################
	#### Series Data Table
	####################

	public function getSerials()
	{
		$query = $this->db->table('serial');
		$data = $query->get()->getResult();

		return $data;
	}

	####################
	#### Tickets Data Table
	####################

	public function getTicketsProcessingData($params)
	{
		$query = $this->db->table('dt_tickets');

		if (!empty($params['search'])) {
			$query->groupStart();
			$query->like('dt_tickets.invoiceNumber', $params['search']);
			$query->orLike('DATE(dt_tickets.added)', $params['search']);
			$query->groupEnd();
		}

		$query->offset($params['start']);
		$query->limit($params['length']);
		$query->orderBy($this->getTicketProcessingSort($params['sortColumn'], $params['sortDir']));

		$data = $query->get()->getResult();

		return $data;
	}

	public function getTicketProcessingSort($column, $dir)
	{
		$sort = '';

		if ($column == 0) {
			if ($dir == 'asc')
				$sort = 'dt_tickets.invoiceNumber ASC';
			else
				$sort = 'dt_tickets.invoiceNumber DESC';
		}

		if ($column == 1) {
			if ($dir == 'asc')
				$sort = 'dt_tickets.pay_type ASC';
			else
				$sort = 'dt_tickets.pay_type DESC';
		}

		if ($column == 2) {
			if ($dir == 'asc')
				$sort = 'dt_tickets.added ASC';
			else
				$sort = 'dt_tickets.added DESC';
		}

		if ($column == 3) {
			if ($dir == 'asc')
				$sort = 'dt_tickets.amount ASC';
			else
				$sort = 'dt_tickets.amount DESC';
		}

		return $sort;
	}

	public function getTotalTickets($params)
	{
		$query = $this->db->table('dt_tickets');

		if (!empty($params['search'])) {
			$query->groupStart();
			$query->like('dt_tickets.invoiceNumber', $params['search']);
			$query->orLike('dt_tickets.added', $params['search']);
			$query->groupEnd();
		}

		return $query->countAllResults();
	}

	####################
	#### Invoice Data Table
	####################

	public function getInvoiceProcessingData($params)
	{
		$query = $this->db->table('dt_invoices');

		if (!empty($params['search'])) {
			$query->groupStart();
			$query->like('dt_invoices.invoiceNumber', $params['search']);
			$query->orLike('DATE(dt_invoices.added)', $params['search']);
			$query->groupEnd();
		}

		$query->offset($params['start']);
		$query->limit($params['length']);
		$query->orderBy($this->getInvoiceProcessingSort($params['sortColumn'], $params['sortDir']));

		$data = $query->get()->getResult();

		return $data;
	}

	public function getInvoiceProcessingSort($column, $dir)
	{
		$sort = '';

		if ($column == 0) {
			if ($dir == 'asc')
				$sort = 'dt_invoices.invoiceStatus ASC';
			else
				$sort = 'dt_invoices.invoiceStatus DESC';
		}

		if ($column == 1) {
			if ($dir == 'asc')
				$sort = 'dt_invoices.invoiceNumber ASC';
			else
				$sort = 'dt_invoices.invoiceNumber DESC';
		}

		if ($column == 2) {
			if ($dir == 'asc')
				$sort = 'dt_invoices.customerName ASC';
			else
				$sort = 'dt_invoices.customerName DESC';
		}

		if ($column == 3) {
			if ($dir == 'asc')
				$sort = 'dt_invoices.added ASC';
			else
				$sort = 'dt_invoices.added DESC';
		}

		if ($column == 4) {
			if ($dir == 'asc')
				$sort = 'dt_invoices.amount ASC';
			else
				$sort = 'dt_invoices.amount DESC';
		}

		return $sort;
	}

	public function getTotalInvoice($params)
	{
		$query = $this->db->table('dt_invoices');

		if (!empty($params['search'])) {
			$query->groupStart();
			$query->like('dt_invoices.invoiceNumber', $params['search']);
			$query->orLike('dt_invoices.added', $params['search']);
			$query->groupEnd();
		}

		return $query->countAllResults();
	}
}
