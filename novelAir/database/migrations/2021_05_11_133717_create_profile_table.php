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
            $table->id();
            $table->unsignedBigInteger('user_id')->length(20);
            $table->boolean('private')->default(false);
            $table->string('imgtype',40)->nullable()->default(null);
            $table->string('presentation',500)->nullable()->default(null);
            $table->unsignedBigInteger('state_id')->length(20)->default(1);
            $table->string('twitter',255)->nullable()->default(null);
            $table->boolean('showTwitter')->default(false);
            $table->string('facebook',255)->nullable()->default(null);
            $table->boolean('showFace')->default(false);
            $table->string('instagram',255)->nullable()->default(null);
            $table->boolean('showInstagram')->default(false);
            $table->string('patreon',255)->nullable()->default(null);
            $table->boolean('showPatreon')->default(false);
            $table->string('other',255)->nullable()->default(null);
            $table->boolean('showOther')->default(false);
            $table->boolean('authorsRecomended')->default(false);
            $table->string('idAuthorsRecomended',40)->nullable()->default(null);
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
