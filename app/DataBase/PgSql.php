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

}