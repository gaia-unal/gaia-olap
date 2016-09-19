<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Entities\Cube;
/**
* 
*/


class CubeRepository extends BaseRepository
{


	public function model()
	{
		return Cube::getClass();
	}

	public function validator()
    {
        return 'App\Validator\CubeValidator';
    }

	public function createObject($cube)
	{
		return new Cube($cube);
	}

}