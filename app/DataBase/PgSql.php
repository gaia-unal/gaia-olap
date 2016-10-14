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
		return "SELECT column_name as name ,data_type as type from information_schema.columns where table_name ='$table'";

	}
	public function selectPrimaryKey($table_name)
	{
		return	"SELECT 
						information_schema.table_constraints.constraint_type,
						information_schema.key_column_usage.column_name as name
						
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
		return	" SELECT 
 						s1.constraint_name, 
 						s1.table_name, 
 						s1.column_name, 
 						s2.table_name_reference, 
 						s2.column_name_reference 
   					FROM ( 
   						SELECT 
   							key_column_usage.constraint_name, 
   							key_column_usage.table_name, 
   							key_column_usage.column_name, 
   							columns.ordinal_position

           				FROM 
           				information_schema.key_column_usage 
      		
      					JOIN 	information_schema.columns 
      							USING (table_name, column_name)) s1

   						JOIN ( 
   							SELECT 	constraint_column_usage.constraint_name, 
   									constraint_column_usage.table_name AS table_name_reference, 
   									constraint_column_usage.column_name AS column_name_reference, 
   										cols_ref.ordinal_position AS ordinal_position_reference

           					FROM 
           						information_schema.constraint_column_usage

				      		JOIN 
				      			information_schema.columns cols_ref ON cols_ref.table_name::text = constraint_column_usage.table_name::text AND 
				      			cols_ref.column_name::text = constraint_column_usage.column_name::text) s2 ON s1.constraint_name::text = s2.constraint_name::text AND NOT 
				   				s1.table_name::text = s2.table_name_reference::text AND s1.table_name = '$table_name';";					
	}

}
