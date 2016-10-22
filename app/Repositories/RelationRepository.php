<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Entities\ForeignKey;

/**
* 
*/


class RelationRepository extends BaseRepository
{

	public function model()
	{
		return ForeignKey::getClass();
	}

	public function validator()
    {
        return 'App\Validator\RelationValidator';
    }

	public function createObject($foreignKey)
	{
		return new ForeignKey($foreignKey);
	}

	public function deletlevel($foreignKeys)
	{
		$foreignKey = null;
		foreach ($foreignKeys as $key => $value)
		{
    		$foreignKey = $value;
		}
		return $foreignKey;
	}

	public function getForeignKey($tableId)
	{
		return $this->findWhere([
				'idLocalTable'=>"$tableId"
			])->lists('nameReferenceTable','idLocalFiel');
	}
	public function getTableField($id)
	{
		return $this->deletlevel($this->findWhere([
				'idLocalFiel'=>"$id"
			]));
	}

}