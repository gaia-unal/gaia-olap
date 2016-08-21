<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Entities\Connection;
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


}
