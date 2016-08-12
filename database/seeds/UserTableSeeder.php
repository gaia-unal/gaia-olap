<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createAdmin();
    }

    private function createAdmin(){

    	User::create([
    		'name' 	=> 'Daniel Espinosa',
    		'email'	=> 'daespinosag@unal.edu.co',
    		'type'	=> 'Admin',
    		'password'	=> bcrypt('secret')
    	]);

    	User::create([
    		'name' 	=> 'Daniel Espinosa',
    		'email'	=> 'mayordan01@gmail.com',
    		'type'	=> 'Creator',
    		'password'	=> bcrypt('secret')
    	]);

    }
}
