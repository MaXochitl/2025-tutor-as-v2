<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosExamenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos_examenes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('periodo_eval_id')->unsigned();
            $table->string('num_control');
            $table->bigInteger('carrera_id')->unsigned();
            $table->string('nombre');
            $table->string('telefono');
            $table->string('correo');
            $table->boolean('status');
            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('cascade');
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
        Schema::dropIfExists('alumnos_examenes');
    }
}
