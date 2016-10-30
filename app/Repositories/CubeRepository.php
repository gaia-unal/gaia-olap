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

	public function deletlevel($cubes)
	{
		$cube = null;
		foreach ($cubes as $key => $value)
		{
    		$cube = $value;
		}
		return $cube;
	}

	public function getConnection($cubeId)
	{
		return $this->find($cubeId)->connectionId;
	}

}