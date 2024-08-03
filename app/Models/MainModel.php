<?php

namespace App\Models;

use CodeIgniter\Model;

class MainModel extends Model
{
	protected $db;

	function  __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
	}

	public function objCreate($table, $data)
	{
		$this->db->table($table)->insert($data);

		$result = array();
		if ($this->db->resultID) {
			$result['error'] = 0;
			$result['id'] = $this->db->connID->insert_id;
		} else {
			$result['error'] = 1;
        }

		return $result;
	}

	public function objUpdate($table, $data, $id)
	{
		$query = $this->db->table($table)
			->where('id', $id)
			->update($data);

		$result = array();

		if ($query == true) {
			$result['error'] = 0;
			$result['id'] = $id;
		} else {
			$result['error'] = 1;
        }

		return $result;
	}

	public function objDelete($table, $id)
	{
		$return = array();

		$query = $this->db->table($table)
			->where('id', $id)
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
}
