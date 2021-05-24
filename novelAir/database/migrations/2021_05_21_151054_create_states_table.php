<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('state_name');
            $table->timestamps();
        });
        DB::table('states')->insert(
            array(
                'state_name' => 'following',
            ),
        );
        DB::table('states')->insert(
            array(
                'state_name' => 'readed',
            ),
        );
        DB::table('states')->insert(
            array(
                'state_name' => 'abandoned',
            ),
        );
        DB::table('states')->insert(
            array(
                'state_name' => 'pending',
            ),
        );
        DB::table('states')->insert(
            array(
                'state_name' => 'favorite',
            ),
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
