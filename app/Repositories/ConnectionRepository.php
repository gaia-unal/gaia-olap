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
		return $this->create($connection->toArray());
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

	public function resultConsult($connectionId,$consult)
	{
		$connection = $this->find($connectionId);
		$this->connectionOnTheFly = new ConnectionOnTheFly($connection);
		$data = $this->connectionOnTheFly->select($consult);
		
		$host= $connection->host;
	    $port= $connection->port;
	    $user= $connection->userName;
	    $pass= $connection->password;
	    $dbname=$connection->database;
		/*
	    $connect = pg_connect("host='localhost', port='5432', user='postgres', pass='eyJpdiI6InBjUGhTbllGV1hRQ3ZqSzd0MmZDaEE9PSIsInZhbHVlIjoiZk1iZHZuQWJiaU1TNWFkUmJiZEpwQlVSUDdJeGdXUWJsczh0WTFYS3ZaVT0iLCJtYWMiOiIwN2E3OTFlYWE1ZWYxNzVjZmIzZTEyMzlmODM0MWMxMmZkMjk5ODlhMzFkMWQ2YTkzZTYyYjI5ZGQ5NjQzZDk4In0=', dbname='bodegaVariablesAmbientales-13-11-15'");

	    $consulta = pg_query($connect, $consult);
	    $data = pg_fetch_array($consulta);*/

		return $data;
	}


}
