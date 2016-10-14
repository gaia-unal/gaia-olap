<?php

namespace App\Validator;

use Prettus\Validator\LaravelValidator;


class FieldValidator extends LaravelValidator {

    protected $rules = [
        	'tableId' 	   	=> 'required',
        	'name'  	   	=> 'required',
        	'masked'		=> 'min:3',
        	'type'			=> 'min:3',
        	'visible'		=> 'min:3'

   	];
   	
   	protected $messages = [
    	'required' => 'El  :attribute es requerido.',
	];

}