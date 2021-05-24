<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uns', function (Blueprint $table) {
            $table->unsignedBigInteger('novel_id')->index('fk_uns_novels');
            $table->unsignedBigInteger('user_id')->index('fk_uns_users');
            $table->unsignedBigInteger('state_id')->index('fk_uns_states');
            $table->timestamps();
            $table->bigInteger('id', true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uns');
    }
}
