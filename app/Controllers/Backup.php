<?php

namespace App\Controllers;

class Backup extends BaseController
{
	protected $objSession;
	protected $objRequest;

	public function createBackup()
	{
		// Get the database connection
		$db = \Config\Database::connect();

		// Get the default database name from the App config
		$dbName = 'factu_soft';

		// Create a filename for the backup file
		$filename = 'backup_' . date('YmdHis') . '.sql';

		// Create a directory to store the backup file if it doesn't exist
		$backupDir = WRITEPATH . 'backups/';
		if (!is_dir($backupDir)) {
			mkdir($backupDir, 0777, true);
		}

		// Generate the SQL dump
		$builder = $db->table('information_schema.tables');
		$builder->where('table_schema', $dbName);
		$tables = $builder->get()->getResult();

		$dump = '-- Database: ' . $dbName . PHP_EOL;
		$dump .= '-- Generation Time: ' . date('Y-m-d H:i:s') . PHP_EOL;
		$dump .= '--' . PHP_EOL;

		foreach ($tables as $table) {
			$tableName = $table->TABLE_NAME;
			$dump .= '-- Table: ' . $tableName . PHP_EOL;
			$dump .= 'DROP TABLE IF EXISTS ' . $tableName . ';' . PHP_EOL;
			$createTable = $db->query("SHOW CREATE TABLE `$tableName`")->getResultArray()[0];
			if (isset($createTable['Create Table'])) {
				$dump .= $createTable['Create Table'] . ';' . PHP_EOL;
			} else {
				// Handle the case where the key doesn't exist
				$dump .= 'CREATE TABLE statement not found.' . PHP_EOL;
			}
			$rows = $db->table($tableName)->get()->getResult();
			foreach ($rows as $row) {
				$dump .= 'INSERT INTO ' . $tableName . ' VALUES (';
				foreach ($row as $field => $value) {
					$dump .= "'" . addslashes($value) . "', ";
				}
				$dump = rtrim($dump, ', ') . ');' . PHP_EOL;
			}
			$dump .= PHP_EOL;
		}

		// Write the SQL dump to a file
		file_put_contents($backupDir . $filename, $dump);

		// Return the filename of the backup file
		return $filename;
	}
}
