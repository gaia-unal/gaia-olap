<?php

namespace App\Validator;

use Prettus\Validator\LaravelValidator;


class CubeValidator extends LaravelValidator {

    protected $rules = [
        	'connectionId' 	   => 'required',
        	'name'  	   => 'required'
        	//'description'		   => 'required',

   	];
   	
   	protected $messages = [
    	'required' => 'El  :attribute es requerido.',
	];

}