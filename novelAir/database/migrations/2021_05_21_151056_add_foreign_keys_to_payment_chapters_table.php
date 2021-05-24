<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPaymentChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_chapters', function (Blueprint $table) {
            $table->foreign('novel_id', 'fk_payment_novels')->references('id')->on('novels')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_chapters', function (Blueprint $table) {
            $table->dropForeign('fk_payment_novels');
        });
    }
}
