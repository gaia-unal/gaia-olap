<?php

namespace App\Validator;

use Prettus\Validator\LaravelValidator;


class ConnectionValidator extends LaravelValidator {

    protected $rules = [
        	'userId' 	   => 'required',
        	'name'  	   => 'required',
        	'host'		   => 'required',
          'port'       => 'required',
          'userName'   => 'required',
          //'password' => 'required||min:3',
          'database'   => 'required',
   	];
   	
   	protected $messages = [
    	'required' => 'El  :attribute es requerido.',
	];

}