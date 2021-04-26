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
            $table->string('novel_dir',255);
            $table->unsignedBigInteger('user_id')->lenght(20);
            $table->unsignedBigInteger('state_id')->lenght(20);
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
        Schema::dropIfExists('uns');
    }
}
