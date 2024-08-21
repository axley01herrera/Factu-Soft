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

	public function getActiveServices($serviceID = null)
	{
		$query = $this->db->table('services')
			->where('deleted', 0);

		if (!empty($serviceID))
			$query->where('id', $serviceID);

		$data = $query->get()->getResult();

		return $data;
	}

	public function getOpenBasket()
	{
		$query = $this->db->table('basket')
			->where('status', 0);
		$data = $query->get()->getResult();

		return $data;
	}

	public function getBasket($basketID)
	{
		$query = $this->db->table('basket')
			->where('id', $basketID);
		$data = $query->get()->getResult();

		return $data;
	}

	public function getBasketServices($basketID)
	{
		$query = $this->db->table('basket_service')
			->where('basketID', $basketID);
		$data = $query->get()->getResult();

		return $data;
	}

	public function clearBasketServices($basketID)
	{
		$return = array();

		$query = $this->db->table('basket_service')
			->where('basketID', $basketID)
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

	public function addServiceToBasket($data)
	{
		$this->db->table('basket_service')
			->insert($data);

		$result = array();
		if ($this->db->resultID) {
			$result['error'] = 0;
			$result['id'] = $this->db->connID->insert_id;
		} else {
			$result['error'] = 1;
		}

		return $result;
	}
}
