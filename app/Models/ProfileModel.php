<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function verifyAccessKey($accessKey)
    {
        $query = $this->db->table('profile');
        $data = $query->get()->getResult();

        if (!empty($data)) {
            if (password_verify($accessKey, $data[0]->access_key)) {
                $result = array();
                $result['error'] = 0;
                $result['msg'] = "SUCCESS_AUTH";

                return $result;
            } else {
                $result = array();
                $result['error'] = 1;
                $result['msg'] = "INVALID_ACCESS_KEY";

                return $result;
            }
        } else {
            $result = array();
            $result['error'] = 99;
            $result['msg'] = "EMPTY_PROFILE_TABLE";

            return $result;
        }
    }

    public function getProfile()
    {
        $query = $this->db->table('profile');
        $data = $query->get()->getResult();

        return @$data[0];
    }

	public function uploadLogo($file)
	{
		$fileContent = file_get_contents($file['tmp_name']);

		$data = array(
			'logo' => $fileContent
		);

		$query = $this->db->table('profile')
			->where('id', 1)
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
}
