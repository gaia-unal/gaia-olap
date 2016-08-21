<?php

namespace App\Validator;

use Prettus\Validator\LaravelValidator;


class UserValidator extends LaravelValidator {

    protected $rules = [
        	'name' 		=> 'min:3',
        	'email'  	=> 'required',
        	'type'		=> 'min:3',
        	//'password'	=> 'min:4||required',
   	];
   	
   	protected $messages = [
    	'required' => 'The :attribute field is required.',
	];

}
