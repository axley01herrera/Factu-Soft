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

    public function getSelCustomers()
    {
        $query = $this->db->table('customer')
            ->where('serial_id !=', NULL);

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
}
