<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Entities\Connection;
use App\Database\ConnectionOnTheFly;
/**
* 
*/


class ConnectionRepository extends BaseRepository
{

	private $connectionOnTheFly;

	public function model()
	{
		return Connection::getClass();
	}

	public function validator()
    {
        return 'App\Validator\ConnectionValidator';
    }

	public function createObject($connection)
	{
		return new Connection($connection);
	}

	public function deletlevel($connections)
	{
		$connection = null;
		foreach ($connections as $key => $value)
		{
    		$connection = $value;
		}
		return $connection;
	}

	public function saveConnection($connection)
	{
		$connection = $this->createObject($connection);
		$connection->password = encrypt($connection-> password);
		return $connection->save();
	}

	public function testConnection($connection)
	{
		$connection = $this->createObject($connection);
		$connection->password = encrypt($connection-> password);
		//$connection = $this->find(1);
		$this->connectionOnTheFly = new ConnectionOnTheFly($connection);
		
		return $reult = $this->connectionOnTheFly->test();

	}

	public function SelectTables($connectionId)
	{
		$connection = $this->find($connectionId);
		$this->connectionOnTheFly = new ConnectionOnTheFly($connection);
		
		return $tables = $this	->connectionOnTheFly
								->SelectTables();
	}

	public function connection()
	{
        $connection = $this->find(1);
		
		$this->connectionOnTheFly = new ConnectionOnTheFly($connection);
		
		//consultar una tabla especifica
		//$users = $connectionOnTheFly->getTable('fact_table');
 
	}


}
