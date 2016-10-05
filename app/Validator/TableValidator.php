<?php

namespace App\Validator;

use Prettus\Validator\LaravelValidator;


class TableValidator extends LaravelValidator {

    protected $rules = [
          'cubeId'  => 'required',
        	'name' 		=> 'required',
        	'masked'  => 'min:3',
        	//'principal'		=> 'min:3',
   	];
   	
   	protected $messages = [
    	'required' => 'The :attribute field is required.',
	];

}
