<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Entities\Table;
use App\Database\ConnectionOnTheFly;
/**
* 
*/

class TableRepository extends BaseRepository
{

	private $connectionOnTheFly;

	public function model()
	{
		return Table::getClass();
	}

	public function validator()
    {
        return 'App\Validator\TableValidator';
    }

	public function createObject($table)
	{
		return new Table($table);
	}

	public function deletlevel($tables)
	{
		$table = null;
		foreach ($tables as $key => $value)
		{
    		$table = $value;
		}
		return $table;
	}

	public function selectColum($table,$connection)
	{
		$this->connectionOnTheFly = new ConnectionOnTheFly($connection);		
		
		$primaryKeys= $this	->connectionOnTheFly
							->selectPrimaryKey($table->name);
		dd($primaryKeys);

		$fields = $this	->connectionOnTheFly
						->selectColum($table->name);

		foreach ($fields as $field_key => $field) {
			
			if (count($primaryKeys) > 1) {
				
				foreach ($primaryKeys as $primaryKey_key => $primaryKey) {
					
					if ($field->column_name == $primaryKey->column_name) {
						$field->primaryKey = true;
					}else{
						$field->primaryKey = false;
					}
				}
			}elseif (count($primaryKeys) = 1) {
				if ($field->column_name == $primaryKeys->column_name) {
					$field->primaryKey = true;
				}else{
					$field->primaryKey = false;
				}	
			}else{
				$field->primaryKey = false;
			}
		}

		return $fields;

	}

	public function selectColumTables($fact_table,$tables,$connection)
	{
		$fact_foreign_key = $this->getForeignKeys($fact_table,$connection);

		foreach ($tables as $key => $value) {
			
			$value->fields = $this->selectColum($value,$connection);
			
			if ($fact_table == $value->name) {
				$value->foreignKeys = $fact_foreign_key;
			}else{
				$value->foreignKeys = false;
			}
			
		
		}

		dd($tables);

		return $tables;
	}

	


	public function getForeignKeys($fact_table,$connection)
	{
		$this->connectionOnTheFly = new ConnectionOnTheFly($connection);
		
		return $foreignKeys= $this	->connectionOnTheFly
									->selectForeignKey($fact_table);

	}
	
}