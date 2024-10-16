<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
	protected $db;

	function  __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
	}

	public function getCollectionDay()
	{
		$query = $this->db->table('invoice')
			->select('SUM(invoice.total_amount) as amount')
			->where("DATE(added)", date('Y-m-d'))
			->where("invoice.status !=2");

		$data = $query->get()->getResult();

		return $data;
	}

	public function getCustomers()
	{
		$query = $this->db->table('customer')
			->where('deleted', 0);
		$data = $query->get()->getResult();

		return $data;
	}

	public function getServices()
	{
		$query = $this->db->table('services')
			->where('deleted', 0);
		$data = $query->get()->getResult();

		return $data;
	}

	public function getPendingInvoices()
	{
		$query = $this->db->table('invoice')
			->select('id')
			->where("invoice.status", 3);

		$data = $query->get()->getResult();

		return $data;
	}

	public function chartMont($year)
	{
		// Definimos el primer y último día del año
		$firstDay = "$year-01-01 00:00:00";
		$lastDay = "$year-12-31 23:59:59";

		// Consulta modificada para asegurar que se agrupa por mes
		$query = $this->db->table('invoice')
			->select('SUM(invoice.total_amount) as totalPrice, MONTH(invoice.added) as month')
			->where("invoice.added >=", $firstDay)
			->where("invoice.added <=", $lastDay)
			->where("invoice.status !=", 2) // Excluir status igual a 2
			->groupBy('MONTH(invoice.added)') // Agrupar por mes
			->orderBy('month', 'ASC'); // Ordenar por mes para asegurar el orden correcto

		// Ejecutamos la consulta y obtenemos los resultados
		$data = $query->get()->getResult();

		// Inicializamos un array con 12 posiciones (1 por cada mes)
		$serie = array_fill(1, 12, 0);
		$total = 0;

		// Recorremos los resultados y los asignamos al mes correspondiente
		foreach ($data as $row) {
			$month = (int) $row->month;
			$serie[$month] = (float) $row->totalPrice;
			$total += $serie[$month]; // Sumamos al total
		}

		// Agregamos el total de todos los meses al final del array
		$serie['total'] = $total;

		// Devolvemos el array que contiene los totales por mes y el total general
		return $serie;
	}

	public function pendingInvoices()
	{
		$query = $this->db->table('dt_invoices')
			->where("invoiceStatus", 3);

		$data = $query->get()->getResult();

		return $data;
	}
}
