<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Rating', function (Blueprint $table) {
            $table->increments('idRating');
            $table->string('rating');
            $table->integer('idTypeService')->unsigned();
            $table->integer('idService')->unsigned();
            $table->foreign('idTypeService')->references('idTypeService')->on('typeService');
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
        Schema::dropIfExists('Rating');
    }
}
