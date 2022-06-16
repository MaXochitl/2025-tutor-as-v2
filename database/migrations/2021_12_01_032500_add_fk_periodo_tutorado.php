<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkPeriodoTutorado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('periodo_tutorado', function (Blueprint $table) {
            //
            $table->bigInteger('semaforo_id');
            $table->foreign('semaforo_id')->references('id')->on('semaforo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tutores', function (Blueprint $table) {
            //
        });
    }
}
