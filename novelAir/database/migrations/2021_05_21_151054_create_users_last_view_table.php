<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersLastViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_last_view', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->unsignedBigInteger('user_id')->index('fk_ulv_users');
            $table->unsignedBigInteger('novel_id')->index('fk_ulv_novels');
            $table->double('chapter_n', 8, 2);
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
        Schema::dropIfExists('users_last_view');
    }
}
