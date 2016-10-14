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
            $table->integer('idLocalFiel');
            $table->integer('idLocalTable');
            $table->integer('idReferenceTable');
            $table->integer('idReferenceFiel');

            $table->string('nameLocalTable')->nullable()->default(null);
            $table->string('nameLocalField')->nullable()->default(null);
            $table->string('nameReferenceTable')->nullable()->default(null);
            $table->string('nameReferenceField')->nullable()->default(null);

            $table->string('nameRelationship')->nullable()->default(null);
            
            $table->foreign('idLocalFiel')->references('id')->on('fields')->onDelete('cascade');
            $table->foreign('idReferenceFiel')->references('id')->on('fields')->onDelete('cascade');
            $table->foreign('idLocalTable')->references('id')->on('tables')->onDelete('cascade');
            $table->foreign('idReferenceTable')->references('id')->on('tables')->onDelete('cascade');


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
