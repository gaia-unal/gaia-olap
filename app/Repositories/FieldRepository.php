<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Entities\Field;

/**
* 
*/


class FieldRepository extends BaseRepository
{

	public function model()
	{
		return Field::getClass();
	}

	public function validator()
    {
        return 'App\Validator\FieldValidator';
    }

	public function createObject($field)
	{
		return new Field($field);
	}
	public function selectField($fieldName,$tableId)
	{
		return $this->findWhere([
					    'tableId'=>"$tableId",
					    'name'=>"$fieldName"
					])->first()->id;
	}
	public function getFieldsTable($tableId)
	{
		return $this->findWhere([
				'tableId'=>"$tableId"
			])->lists('name', 'id');

	}

}