<?php

namespace App\Repositories;

use App\Entities\Connection;
/**
* 
*/
class ConnectionRepository extends BaseRepository
{

	public function getModel()
	{
		return new Connection();
	}

	public function createObject($connection)
	{
		return new Connection($connection);
	}

	public function paginateConnections($id)
	{
		return $this->newQuery()
					->where('userId', $id)
					->orderBy('id','ASC')
					->paginate(10);
	}

	public function consultConnection($id)
	{
		return $this->newQuery()
					->findOrFail($id);
	}

	public function saveConnection(Connection $connection)
	{ 
		$connection->password = encrypt($connection-> password);
		return $connection->save();

	}

	public function updateConnection($data, $id)
	{
		
		return $this->newQuery()
					->findOrFail($id)
					->fill($data)
					->save();
	}

}
