<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Place', function (Blueprint $table) {
            $table->increments('idPlace');
            $table->string('namePlace');
            $table->float('MoneyToTravel');
            $table->string('address');
            $table->string('img');
            $table->integer('idType')->unsigned();
            $table->string('description');
            $table->string('latlog');
            $table->integer('idAccount')->unsigned()->nullable();
            $table->foreign('idAccount')->references('idAccount')->on('Account');
            $table->foreign('idType')->references('idType')->on('typePlace');
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
        Schema::dropIfExists('Place');
    }
}