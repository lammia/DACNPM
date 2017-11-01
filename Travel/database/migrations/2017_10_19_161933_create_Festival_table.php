<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFestivalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Festival', function (Blueprint $table) {
            $table->increments('idFestival');
            $table->string('nameFestival');
            $table->integer('idPlace')->unsigned();
            $table->datetime('timeBeginFestival');
            $table->datetime('timeEndFestival');
            $table->string('Description');
            $table->string('img');
            $table->integer('idAccount')->unsigned()->nullable();
            $table->foreign('idPlace')->references('idPlace')->on('Place');
            $table->foreign('idAccount')->references('idAccount')->on('Account');
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
        Schema::dropIfExists('Festival');
    }
}
