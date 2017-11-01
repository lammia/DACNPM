<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Event', function (Blueprint $table) {
            $table->increments('idEvent');
            $table->string('nameEvent');
            $table->integer('idPlace')->unsigned();
            $table->datetime('timeBeginEvent');
            $table->datetime('timeEndEvent');
            $table->string('description');
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
        Schema::dropIfExists('Event');
    }
}