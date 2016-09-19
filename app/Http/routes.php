<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function(){
	
	Route::group(['middleware' => 'role:Admin', 'prefix' => 'Admin'], function(){
		
		Route::get('/',[
			'uses' 	=> 'AdminController@index',
			'as'	=> 'Admin.index'
		]);

		Route::resource('user','UserController');
	
	});


	Route::group(['middleware' => 'role:Creator', 'prefix' => 'Creator'], function(){
		
		Route::get('/',[
			'uses' 	=> 'CreatorController@index',
			'as'	=> 'Creator.index'
		]);

		Route::resource('connection','ConnectionController');

		Route::resource('cube','cubeController');


	});

});

