<?php

namespace App\Validator;

use Prettus\Validator\LaravelValidator;


class RelationValidator extends LaravelValidator {

    protected $rules = [
        'idLocalFiel' 			=> 'required',
        'idLocalTable' 			=> 'required', 
        'idReferenceTable'		=> 'required',
        'idReferenceFiel'		=> 'required',
        'nameLocalTable'		=> 'min:1',
        'nameLocalField'		=> 'min:1',
        'nameReferenceTable'	=> 'min:1',
        'nameReferenceField'	=> 'min:1',
        'nameRelationship'		=> 'min:1'
   	];
   	
   	protected $messages = [
    	'required' => 'El  :attribute es requerido.',
	];

}