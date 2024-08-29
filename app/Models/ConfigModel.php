<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfigModel extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function getConfig()
    {
        $query = $this->db->table('config');
        $data = $query->get()->getResult();

        if (empty($data)) {
            $d = array();
            $d['lang'] = 'es';
            $d['timezone'] = 'Atlantic/Canary';
            $d['currency'] = '€';
            $this->db->table('config')->insert($d); // Create Config

            $d = array();
            $d['access_key'] = '$2y$10$k/0mttt2zPfZ3P2SCfTRZeQQmQkX3ySC3fN4xfydKQluIDkBQoPNS';
            $this->db->table('profile')->insert($d); // Create Profile

            $d = array();
            $d['name'] = 'T';
            $d['count'] = 0;
            $d['created'] = date('Y-m-d H:i:s');
            $d['updated'] = date('Y-m-d H:i:s');
            $this->db->table('serial')->insert($d); // Create Serie to TPV

            $d = array();
            $d['name'] = 'R';
            $d['count'] = 0;
            $d['created'] = date('Y-m-d H:i:s');
            $d['updated'] = date('Y-m-d H:i:s');
            $this->db->table('serial')->insert($d); // Create Serie to Rectify

            $d = array();
            $d['name'] = 'F';
            $d['count'] = 0;
            $d['created'] = date('Y-m-d H:i:s');
            $d['updated'] = date('Y-m-d H:i:s');
            $this->db->table('serial')->insert($d); // Create Serie to Invoice

            $d = array();
            $d['name'] = 'Exento Canarias';
            $d['description'] = 'EXENTO IGIC. REPEP, REGIMEN PEQUEÑO EMPRESARIO O PROFESIONAL';
            $d['percent'] = 0;
            $d['operator'] = "";
            $this->db->table('tax')->insert($d); // Create Tax 

            $d = array();
            $d['name'] = 'Exento Península';
            $d['description'] = 'EXENTO IGIC. ART. 17 Uno 3 de la Ley 20/1991, de 7 de junio, de modificación de los aspectos fiscales';
            $d['percent'] = 0;
            $d['operator'] = "";
            $this->db->table('tax')->insert($d); // Create Tax 

            $d = array();
            $d['name'] = 'IRPF';
            $d['description'] = 'IRPF (7%)';
            $d['percent'] = 7;
            $d['operator'] = "-";
            $this->db->table('tax')->insert($d); // Create Tax 

            $d = array();
            $d['name'] = 'IRPF';
            $d['description'] = 'IRPF (15%)';
            $d['percent'] = 15;
            $d['operator'] = "-";
            $this->db->table('tax')->insert($d); // Create Tax 

            $d = array();
            $d['name'] = 'IGIC';
            $d['description'] = 'IGIC (7%)';
            $d['percent'] = 7;
            $d['operator'] = "+";
            $this->db->table('tax')->insert($d); // Create Tax

            $d = array();
            $d['name'] = 'IVA';
            $d['description'] = 'IVA (21%)';
            $d['percent'] = 21;
            $d['operator'] = "+";
            $this->db->table('tax')->insert($d); // Create Tax

        }

        return $data;
    }
}
