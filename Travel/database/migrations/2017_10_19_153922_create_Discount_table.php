<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Discount', function (Blueprint $table) {
            $table->increments('idDiscount');
            $table->integer('idAccount')->unsigned()->nullable();
            $table->float('percentDiscount');
            $table->datetime('timeBeginDiscount');
            $table->datetime('timeEndDiscount');
            $table->integer('idPlace')->unsigned();
            $table->foreign('idAccount')->references('idAccount')->on('Account');
            $table->foreign('idPlace')->references('idPlace')->on('Place');
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
        Schema::dropIfExists('Discount');
    }
}
