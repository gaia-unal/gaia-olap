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
		return "SELECT column_name,data_type from information_schema.columns where table_name ='$table'";

	}
	public function selectPrimaryKey($table_name)
	{
		return	"SELECT 
						information_schema.table_constraints.constraint_type,
						information_schema.key_column_usage.column_name
						
					FROM 
						information_schema.table_constraints,
						information_schema.key_column_usage

					WHERE 
						information_schema.table_constraints.constraint_type = 'PRIMARY KEY' and
						information_schema.key_column_usage.table_schema = 'public' and
						information_schema.table_constraints.table_name = '$table_name' and
						information_schema.table_constraints.constraint_name = information_schema.key_column_usage.constraint_name ";
	}

	public function selectForeignKey($table_name)
	{
		return	"SELECT constraint_name,column_name from information_schema.key_column_usage where table_name = '$table_name'";					
	}

}

	