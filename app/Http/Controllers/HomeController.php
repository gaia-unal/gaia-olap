<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\CubeRepository;
use App\Repositories\ConnectionRepository;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    
    private $cubeRepository;
    private $connectionRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct
    (
        CubeRepository $cubeRepository,
        ConnectionRepository $connectionRepository
    )
    {
        $this->middleware('auth');
        $this->cubeRepository = $cubeRepository;
        $this->connectionRepository = $connectionRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return view('home');
    }
}