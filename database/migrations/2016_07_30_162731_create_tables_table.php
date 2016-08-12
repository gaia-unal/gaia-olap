<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('cubeId');
            $table->string('name');
            $table->string('masked')->nullable()->default(null);
            $table->boolean('principal')->default(false);

            $table->foreign('cubeId')->references('id')->on('cubes')->onDelete('cascade');


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
        Schema::drop('tables');
    }
}
