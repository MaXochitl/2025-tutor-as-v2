<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodoSemaforo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodo_semaforo', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('periodo_id')->unsigned();
            $table->bigInteger('semaforo_id');
            $table->integer('semestre');
            $table->foreign('periodo_id')->references('id')->on('periodo_tutorado')->onDelete('cascade');
            $table->foreign('semaforo_id')->references('id')->on('semaforo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periodo_semaforo');
    }
}
