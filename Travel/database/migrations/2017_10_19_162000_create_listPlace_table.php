<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listPlace', function (Blueprint $table) {
            $table->increments('idlistPlace');
            $table->integer('idSchedule')->unsigned();
            $table->integer('idPlace')->unsigned();
            $table->datetime('timeBeginTravel');
            $table->datetime('timeEndTravel');
            $table->integer('idEvent')->unsigned();
            $table->integer('idFestival')->unsigned();
            $table->integer('idDiscount')->unsigned()->nullable();
            $table->foreign('idSchedule')->references('idSchedule')->on('Schedule');
            $table->foreign('idPlace')->references('idPlace')->on('Place');
            $table->foreign('idEvent')->references('idEvent')->on('Event');
            $table->foreign('idFestival')->references('idFestival')->on('Festival');
            $table->foreign('idDiscount')->references('idDiscount')->on('Discount');
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
        Schema::dropIfExists('listPlace');
    }
}
