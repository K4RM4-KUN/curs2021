<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNovelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->lenght(20);
            $table->string('name',255);
            $table->string('genre',255);
            $table->string('sinopsis',400);
            $table->boolean('public');
            $table->boolean('adult_content');
            $table->boolean('visual_novel');
            $table->string('novel_type',255);
            $table->string('novel_dir',400);
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
        Schema::dropIfExists('novels');
    }
}
