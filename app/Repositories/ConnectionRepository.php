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
		//dd($connection);
		$connectionOnTheFly = new ConnectionOnTheFly($connection);
		
		//dd($connectionOnTheFly);
		

		$users = $connectionOnTheFly
					->select("SELECT tablename FROM pg_tables WHERE schemaname = 'public'");

		dd($users);

		$users = $connectionOnTheFly->getTable('fact_table');
		// Find the first user in the table
		$first_user = $users->first();

		dd($first_user);
	}


}
