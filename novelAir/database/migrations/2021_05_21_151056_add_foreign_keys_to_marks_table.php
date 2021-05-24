<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marks', function (Blueprint $table) {
            $table->foreign('novel_id', 'fk_marks_novels')->references('id')->on('novels')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'fk_marks_users')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marks', function (Blueprint $table) {
            $table->dropForeign('fk_marks_novels');
            $table->dropForeign('fk_marks_users');
        });
    }
}
