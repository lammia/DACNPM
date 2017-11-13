<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAcountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::table('Account', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->integer('idProvince')->unsigned();
            $table->integer('idDistrict')->unsigned();
            $table->foreign('idProvince')->references('idProvince')->on('Province')->onDelete('cascade');
            $table->foreign('idDistrict')->references('idDistrict')->on('District')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('Account', function (Blueprint $table) {
            $table->string('address');
            $table->dropColumn('idProvince');
            $table->dropColumn('idDistrict');
            $table->dropForeign('Account_idProvince_foreign');
            $table->dropForeign('Account_idDistrict_foreign');
        });
    }
}
