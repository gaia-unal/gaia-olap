<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\ConnectionRepository;
use App\Validator\ConnectionValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class CreatorController extends Controller
{
    private $connectionRepository;

    private $validator;

    public function __construct(
        ConnectionRepository $connectionRepository,
        ConnectionValidator $validator
        ){
        
        $this->connectionRepository = $connectionRepository;
        $this->validator = $validator;
    }

    public function index()
    {
    	return view('Creator.index');
    }

    public function processComplete()
    {
    	return view('Creator.processComplete');
    }
}
