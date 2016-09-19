<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConexionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connections', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('userId');
            $table->string('name');
            $table->enum('motor',['pgsql','mysql'])->default('pgsql');
            $table->string('host');
            $table->string('port');
            $table->string('userName');
            $table->string('password');
            $table->string('database');

            $table->string('prefix')->default('utf8');
            $table->string('schema')->default('public');

            $table->string('collaction')->default('utf8_unicode_ci');  
            $table->boolean('strict')->default(true);
            $table->string('engine')->nullable()->default(null);      



            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('connections');
    }
}
