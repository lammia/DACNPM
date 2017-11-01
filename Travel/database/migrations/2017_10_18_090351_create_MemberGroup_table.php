<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MemberGroup', function (Blueprint $table) {
            $table->increments('idMember');
            $table->integer('idAccount')->unsigned();
            $table->integer('idGroup')->unsigned();
            $table->foreign('idAccount')->references('idAccount')->on('Account');
            $table->foreign('idGroup')->references('idGroup')->on('Group');
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
        Schema::dropIfExists('MemberGroup');
    }
}