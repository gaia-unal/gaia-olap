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
		
		return $fields = $this	->connectionOnTheFly
								->selectColum($table->name);
	}

	public function selectColumTables($tables,$connection)
	{
		foreach ($tables as $key => $value) {
			$value->fields = $this->selectColum($value,$connection);
		}

		return $tables;
	}

}