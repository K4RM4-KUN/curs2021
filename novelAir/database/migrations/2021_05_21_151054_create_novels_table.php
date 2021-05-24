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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('fk_novels_users');
            $table->string('name');
            $table->bigInteger('genre');
            $table->string('sinopsis', 600);
            $table->string('author_comment', 400)->nullable();
            $table->string('imgtype', 50);
            $table->boolean('public');
            $table->boolean('adult_content');
            $table->boolean('visual_novel');
            $table->string('novel_type');
            $table->boolean('block')->default(0);
            $table->string('novel_dir', 400)->nullable();
            $table->boolean('ended')->default(0);
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
