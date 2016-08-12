<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foreignKey', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('fieldId');
            $table->integer('tableId');

            $table->string('nameRelationship')->nullable()->default(null);
            
            $table->foreign('fieldId')->references('id')->on('fields')->onDelete('cascade');
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
        Schema::drop('foreignKey');
    }
}
