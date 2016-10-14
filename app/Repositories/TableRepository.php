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

		$fields = $this	->connectionOnTheFly
						->selectColum($table->name);

		$primariKeys= $this	->connectionOnTheFly
							->selectPrimaryKey($table->name);
		
		if ($primariKeys) {
			$table->primariKey = true;
		}else{
			$table->primariKey= false;
		}

		return $this->intagrationPrimaryKey($fields,$primariKeys,$table->id);

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

		return $tables;
	}

	


	public function getForeignKeys($fact_table,$connection)
	{
		$this->connectionOnTheFly = new ConnectionOnTheFly($connection);
		
		return $foreignKeys= $this	->connectionOnTheFly
									->selectForeignKey($fact_table);

	}

	public function getPrimaryKeys($table_name,$connection)
	{
		$this->connectionOnTheFly = new ConnectionOnTheFly($connection);
		
		return $foreignKeys= $this	->connectionOnTheFly
									->selectPrimaryKey($table_name);
	}

	public function intagrationPrimaryKey($fields,$primariKeys,$tableId)
	{
		foreach ($fields as $fieldskey => $field) {
			$field->primariKey = false;
			foreach ($primariKeys as $key => $value) {
				
				$field->tableId = $tableId;
				if ($field->name == $value->name) {
					$field->primariKey = true;
				}
			}
		}

		return $fields; 
	}

	public function selectTable($tableName,$cubeId)
	{
		return $this->findWhere([
					    'cubeId'=>"$cubeId",
					    'name'=>"$tableName"
					])->first()->id;
	}
	
}