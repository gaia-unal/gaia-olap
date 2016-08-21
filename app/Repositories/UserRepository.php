<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Entities\User;

/**
* 
*/
class UserRepository extends BaseRepository
{
	public function model()
	{
		return User::getClass();
	}

	public function validator()
    {
        return 'App\Validator\UserValidator';
    }

    public function createObject($user)
	{
		return new User($user);
	}

   	public function saveUser($user)
	{
		$user = $this->createObject($user);
		$user->password = bcrypt($user-> password);
		return $user->save();

	}

}
