<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Authorize', function (Blueprint $table) {
            $table->increments('idAuthorize');
            $table->integer('idGroup')->unsigned();
            $table->integer('idFunction')->unsigned();
            $table->boolean('isEnable');
            $table->foreign('idGroup')->references('idGroup')->on('Group');
            $table->foreign('idFunction')->references('idFunction')->on('Function');
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
        Schema::dropIfExists('Authorize');
    }
}