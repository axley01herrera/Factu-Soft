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
		$this->db->table($table)
			->insert($data);

		$result = array();
		if ($this->db->resultID) {
			$result['error'] = 0;
			$result['id'] = $this->db->connID->insert_id;
		} else
			$result['error'] = 1;

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
		} else
			$result['error'] = 1;

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

	public function objData($table, $field = null, $value = null)
	{
		$query = $this->db->table($table);

		if (!empty($field))
			$query->where($field, $value);

		return $query->get()->getResult();
	}

	public function uploadFile($table, $id, $field, $file)
	{
		$fileContent = file_get_contents($file['tmp_name']);

		$data = array(
			$field => $fileContent
		);

		$query = $this->db->table($table)
			->where('id', $id)
			->update($data);

		$result = array();

		if ($query == true) {
			$result['error'] = 0;
		} else {
			$result['error'] = 1;
			$result['msg'] = 'fail upload file';
		}

		return $result;
	}

	public function objVerifyCredentials($email, $password)
	{
		$query = $this->db->table('t_customer')
			->where('email', $email);

		$data = $query->get()->getResult();

		if (!empty($data)) {
			if ($data[0]->status == 1) {
				if (password_verify($password, $data[0]->password)) {
					$result = array();
					$result['error'] = 0;
					$result['msg'] = 'success';
					$result['data'] = $data;
				} else {
					$result['error'] = 1;
					$result['msg'] = 'invalid password';
				}
			} else {
				$result = array();
				$result['error'] = 403;
				$result['msg'] = 'user disabled';
			}
		} else {
			$result = array();
			$result['error'] = 500;
			$result['msg'] = 'email not found';
		}

		return $result;
	}

	public function checkDuplicateClientEmail($email, $clientID)
	{
		$query = $this->db->table('clients')
			->where('email', $email)
			->where('deleted', 0);

		if ($clientID != NULL)
			$query->where('id!=', $clientID);

		$data = $query->get()->getResult();

		return $data;
	}

	public function isDuplicateCustomerPhone($phone, $customerID)
	{
		$query = $this->db->table('customer')
			->where('phone', $phone)
			->where('deleted', 0);

		if (!empty($customerID))
			$query->where('id!=', $customerID);

		$data = $query->get()->getResult();

		return $data;
	}

	public function isDuplicateEmployeeEmail($email, $employeeID)
	{
		$query = $this->db->table('employee')
			->where('email', $email)
			->where('deleted', 0);

		if (!empty($employeeID))
			$query->where('id!=', $employeeID);

		$data = $query->get()->getResult();

		return $data;
	}

	public function isDuplicateEmployeePhone($phone, $employeeID)
	{
		$query = $this->db->table('employee')
			->where('phone', $phone)
			->where('deleted', 0);

		if (!empty($employeeID))
			$query->where('id!=', $employeeID);

		$data = $query->get()->getResult();

		return $data;
	}
}
