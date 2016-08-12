<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CreatorController extends Controller
{
    
    public function index()
    {
    	return view('Creator.index');
    }
}
