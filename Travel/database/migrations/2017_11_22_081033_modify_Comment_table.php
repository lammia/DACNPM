<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Comment', function (Blueprint $table) {
            //
            $table->dropColumn('context');
            $table->string('content');
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
        Schema::table('Comment', function (Blueprint $table) {
            //
            $table->string('context');
            $table->dropColumn('content');
            $table->dropColumn('idAccount');
            $table->dropForeign('Comment_idAccount_foreign');
        });
    }
}
