<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('fk_user_id');
            $table->boolean('private')->default(0);
            $table->string('imgtype', 40)->nullable();
            $table->string('presentation', 500)->nullable();
            $table->unsignedBigInteger('state_id')->default(1);
            $table->string('twitter')->nullable();
            $table->boolean('showTwitter')->default(0);
            $table->string('facebook')->nullable();
            $table->boolean('showFace')->default(0);
            $table->string('instagram')->nullable();
            $table->boolean('showInstagram')->default(0);
            $table->string('patreon')->nullable();
            $table->boolean('showPatreon')->default(0);
            $table->string('other')->nullable();
            $table->boolean('authorsRecomended')->nullable()->default(0);
            $table->string('idAuthorsRecomended', 40)->nullable();
            $table->boolean('showOther')->default(0);
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
        Schema::dropIfExists('profile');
    }
}
