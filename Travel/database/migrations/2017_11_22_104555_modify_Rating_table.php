<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Rating', function (Blueprint $table) {
            //
            $table->integer('idAccount')->unsigned();
            $table->foreign('idAccount')->references('idAccount')->on('Account')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Rating', function (Blueprint $table) {
            //
            $table->dropColumn('idAccount');
            $table->dropForeign('Rating_idAccount_foreign');
        });
    }
}
