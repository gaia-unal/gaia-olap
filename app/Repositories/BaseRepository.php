<?php

namespace App\Repositories;

/**
* 
*/
abstract class BaseRepository
{

	abstract public function getModel();

	public function newQuery()
	{
		return $this->getModel()
					->newQuery();
	}

	public function findOrFail($id)
	{
		return $this->newQuery()
					->findOrFail($id);
	}
	public function delete($id)
	{
		return $this->findOrFail($id)
					->delete();
	}








	public function createObject($user)
	{
		return new User($user);
	}

	public function paginateUsers()
	{
		return $this->newQuery()
					->orderBy('id','ASC')
					->paginate(10);
	}

	public function consultUser($id)
	{
		return $this->newQuery()
					->findOrFail($id);
	}

	public function saveUser(User $user)
	{ 
		$user->password = bcrypt($user-> password);
		return $user->save();

	}

	public function updateUser($data, $id)
	{
		
		return $this->newQuery()
					->findOrFail($id)
					->fill($data)
					->save();
	}

}