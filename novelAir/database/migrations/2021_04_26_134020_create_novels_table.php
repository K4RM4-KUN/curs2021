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
            $table->unsignedBigInteger('genre')->lenght(20);
            $table->string('sinopsis',600);
            $table->string('author_comment',400);
            $table->string('imgtype',50);
            $table->boolean('public');
            $table->boolean('ended');
            $table->boolean('adult_content');
            $table->boolean('blocked');
            $table->boolean('visual_novel');
            $table->string('novel_type',255);
            $table->string('novel_dir',400)->nullable();
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
