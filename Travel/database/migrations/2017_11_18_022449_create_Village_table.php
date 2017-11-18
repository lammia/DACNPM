<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Village', function (Blueprint $table) {
            $table->increments('idVillage');
            $table->integer('idDistrict')->unsigned();
            $table->string('name');
            $table->foreign('idDistrict')->references('idDistrict')->on('District');
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
        Schema::dropIfExists('Village');
    }
}
