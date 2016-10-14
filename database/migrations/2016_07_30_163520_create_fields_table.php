<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('tableId');
            $table->string('name');
            $table->string('type');
            $table->string('masked')->nullable()->default(null);
            $table->boolean('visible')->default(true);
            $table->boolean('primariKey')->default(false);
            
            $table->foreign('tableId')->references('id')->on('tables')->onDelete('cascade');


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
        Schema::drop('fields');
    }
}
