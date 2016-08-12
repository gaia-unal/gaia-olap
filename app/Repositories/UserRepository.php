<?php

namespace App\Repositories;

use App\Entities\User;
/**
* 
*/
class UserRepository extends BaseRepository
{

	public function getModel()
	{
		return new User();
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
