<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rol_name');
            $table->timestamps();
        });
        DB::table('roles')->insert(
            array(
                'rol_name' => 'user',
            ),
        );
        DB::table('roles')->insert(
            array(
                'rol_name' => 'author',
            ),
        );
        DB::table('roles')->insert(
            array(
                'rol_name' => 'admin',
            ),
        );
        DB::table('roles')->insert(
            array(
                'rol_name' => 'bloqueado',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
