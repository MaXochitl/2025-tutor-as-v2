<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultados', function (Blueprint $table) {
            $table->id();
            $table->string('alumno_id');
            $table->bigInteger('periodo_eval_id')->unsigned();
            $table->integer('psicometrico_I')->default(0);
            $table->integer('psicometrico_II')->default(0);
            $table->integer('psicometrico_III')->default(0);
            $table->integer('psicometrico_IV')->default(0);
            $table->integer('psicometrico_V')->default(0);
            $table->integer('psicometrico_VI')->default(0);
            $table->integer('razonamiento')->default(0);
            $table->integer('socioeconomico')->default(0);
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade');
            $table->foreign('periodo_eval_id')->references('id')->on('periodo_eval')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resultados');
    }
}
