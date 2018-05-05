<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNumberView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            create view bangso as
            select ( number1.so * 10 * 10 * 10 + number2.so * 10 * 10 + number3.so * 10 + number4.so )
            from number as number1, number as number2, number as number3, number as number4
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS bangso');
    }
}
