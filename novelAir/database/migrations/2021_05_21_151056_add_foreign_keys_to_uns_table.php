<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uns', function (Blueprint $table) {
            $table->foreign('novel_id', 'fk_uns_novels')->references('id')->on('novels')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('state_id', 'fk_uns_states')->references('id')->on('states')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'fk_uns_users')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uns', function (Blueprint $table) {
            $table->dropForeign('fk_uns_novels');
            $table->dropForeign('fk_uns_states');
            $table->dropForeign('fk_uns_users');
        });
    }
}
