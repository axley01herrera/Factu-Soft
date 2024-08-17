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
	#### Client DT
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
}
