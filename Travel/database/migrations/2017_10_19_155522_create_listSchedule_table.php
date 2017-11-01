<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listSchedule', function (Blueprint $table) {
            $table->increments('idlistSchedule');
            $table->integer('idAccount')->unsigned();
            $table->integer('idSchedule')->unsigned();
            $table->datetime('timeSearch');
            $table->foreign('idAccount')->references('idAccount')->on('Account');
            $table->foreign('idSchedule')->references('idSchedule')->on('Schedule');
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
        Schema::dropIfExists('listSchedule');
    }
}
