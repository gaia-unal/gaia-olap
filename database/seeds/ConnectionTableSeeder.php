<?php

use Illuminate\Database\Seeder;
use App\Entities\Connection;


class ConnectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Connection::create([
    		'userId' 	=> 1,
    		'name'		=> 'idea Local',
            'motor'     => 'pgsql',
    		'host'		=> 'localhost',
    		'port'		=> 5432,
    		'userName'	=> 'postgres',
    		'password'	=> encrypt('administrador'),
    		'database'	=> 'bodegaVariablesAmbientales-13-11-15'
    	]);

    	Connection::create([
    		'userId' 	=> 2,
    		'name'		=> 'idea',
            'motor'     => 'pgsql',
    		'host'		=> 'froac.manizales.unal.edu.co',
    		'port'		=> 5432,
    		'userName'	=> 'postgres',
    		'password'	=> encrypt('%froac$'),
    		'database'	=> 'bodegaVariablesAmbientales-13-11-15'
    	]);

    	Connection::create([
    		'userId' 	=> 2,
    		'name'		=> 'idea',
            'motor'     => 'pgsql',
    		'host'		=> 'froac.manizales.unal.edu.co',
    		'port'		=> 5432,
    		'userName'	=> 'postgres',
    		'password'	=> encrypt('%froac$'),
    		'database'	=> 'bodegaVariablesAmbientales-13-11-15'
    	]);
    }
}
