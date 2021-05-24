<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('genres')->insert(
            array(
                'name' => 'drama',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'fantasia',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'comedia',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'accion',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'recuentos de la vida',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'romance',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'superheroe',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'sci-fi',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'suspense',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'sobrenatural',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'misterio',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'deportes',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'isekai',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'horror',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'shounen',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'harem',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'ecchi',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'artes marciales',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'reencarnacion',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'magia',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'apocaliptico',
            ),
        );
        DB::table('genres')->insert(
            array(
                'name' => 'otro',
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
        Schema::dropIfExists('genres');
    }
}
