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


		Route::get('/processComplete',[
			'uses' 	=> 'CreatorController@processComplete',
			'as'	=> 'Creator.processComplete'
		]);


		Route::group(['prefix' => 'processComplete'], function(){
		
			Route::get('/',[
				'uses' 	=> 'processCompleteController@index',
				'as'	=> 'Creator.processComplete.index'
			]);

			Route::post('/selectedConnection',[
				'uses' 	=> 'processCompleteController@selectedConnection',
				'as'	=> 'Creator.processComplete.selectedConnection'
			]);

			Route::get('/createdConnection',[
				'uses' 	=> 'processCompleteController@createdConnection',
				'as'	=> 'Creator.processComplete.createdConnection'
			]);

			Route::post('/storeConnection',[
				'uses' 	=> 'processCompleteController@storeConnection',
				'as'	=> 'Creator.processComplete.storeConnection'
			]);

			Route::post('/storeCube',[
				'uses' 	=> 'processCompleteController@storeCube',
				'as'	=> 'Creator.processComplete.storeCube'
			]);

			Route::get('/cubeTable/{cubeId}',[
				'uses' 	=> 'processCompleteController@cubeTable',
				'as'	=> 'Creator.processComplete.cubeTable'
			]);

			Route::post('/proccessTables',[
				'uses' 	=> 'processCompleteController@proccessTables',
				'as'	=> 'Creator.processComplete.proccessTables'
			]);

			Route::get('/validateField/{cubeId}',[
				'uses' 	=> 'processCompleteController@validateField',
				'as'	=> 'Creator.processComplete.validateField'
			]);
		});


		Route::group(['prefix' => 'Dashboard'], function(){

			Route::get('/{cubeId}',[
				'uses' 	=> 'DashboardController@index',
				'as'	=> 'Creator.Dashboard.index'
			]);

			Route::get('/getDimensionFields/{id}',[
				'uses' 	=> 'DashboardController@getDimensionFields',
				'as'	=> 'Creator.Dashboard.getDimensionFields'
			]);

		});
	});

});

