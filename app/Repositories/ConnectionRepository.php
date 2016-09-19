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

	public function saveConnection($connection)
	{
		$connection = $this->createObject($connection);
		$connection->password = encrypt($connection-> password);
		return $connection->save();
	}

	public function connection()
	{
        $connection = $this->find(1);
		
		$this->connectionOnTheFly = new ConnectionOnTheFly($connection);
		
		// consultar todas las tablas
		//$users = $this->connectionOnTheFly->SelectTables();
		
		//consultar una tabla especifica
		//$users = $connectionOnTheFly->getTable('fact_table');
 
	}


}
