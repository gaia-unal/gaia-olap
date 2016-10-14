<?php

namespace App\Validator;

use Prettus\Validator\LaravelValidator;


class RelationValidator extends LaravelValidator {

    protected $rules = [
        'idLocalFiel' 			=> 'required',
        'idLocalTable' 			=> 'required', 
        'idReferenceTable'		=> 'required',
        'idReferenceFiel'		=> 'required',
        'nameLocalTable'		=> 'min:3',
        'nameLocalField'		=> 'min:3',
        'nameReferenceTable'	=> 'min:3',
        'nameReferenceField'	=> 'min:3',
        'nameRelationship'		=> 'min:3'
   	];
   	
   	protected $messages = [
    	'required' => 'El  :attribute es requerido.',
	];

}