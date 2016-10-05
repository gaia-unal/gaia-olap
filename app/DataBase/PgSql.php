<?php
namespace App\DataBase;

class PgSql {

	public function getOption($connection)
	{
		return [
					'driver' 	=> 'pgsql',
			        'host' 		=> $connection->host,
			        'port' 		=> $connection->port,
					'database' 	=> $connection->database,
					'username' 	=> $connection->userName,
					'password' 	=> decrypt($connection->password),
					'charset' 	=> 'utf8',
			        'prefix' 	=> '',
	        ];
	}
	public function SelectTables()
	{
		return "SELECT tablename FROM pg_tables WHERE schemaname = 'public'";
	}
	public function selectCampos($table)
	{
		return "SELECT column_name from information_schema.columns where table_name ='$table'";
	}
	public function selectSchema($table)
	{
		return "SELECT a.CONSTRAINT_NAME FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS a 
                            JOIN INFORMATION_SCHEMA.CONSTRAINT_COLUMN_USAGE b on a.CONSTRAINT_NAME = b.CONSTRAINT_NAME
                            WHERE a.TABLE_NAME = '$table' AND b.COLUMN_NAME = '$column' AND a.CONSTRAINT_TYPE = 'PRIMARY KEY'";
	}

}

