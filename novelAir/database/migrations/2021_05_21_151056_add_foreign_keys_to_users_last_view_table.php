<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsersLastViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_last_view', function (Blueprint $table) {
            $table->foreign('novel_id', 'fk_ulv_novels')->references('id')->on('novels')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'fk_ulv_users')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_last_view', function (Blueprint $table) {
            $table->dropForeign('fk_ulv_novels');
            $table->dropForeign('fk_ulv_users');
        });
    }
}
