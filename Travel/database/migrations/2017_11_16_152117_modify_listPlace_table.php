<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyListPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listPlace', function (Blueprint $table) {
            //
            $table->dropColumn('timeBeginTravel');
            $table->dropColumn('timeEndTravel');
            $table->integer('numDayTravel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listPlace', function (Blueprint $table) {
            //
            $table->datetime('timeBeginTravel');
            $table->datetime('timeEndTravel');
            $table->dropColumn('numDayTravel');
        });
    }
}
