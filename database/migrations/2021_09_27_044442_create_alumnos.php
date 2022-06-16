<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
           // $table->bigIncrements('id');
            //$table->string('num_control')->unique();
            $table->string('id')->primary();
            $table->string('nombre');
            $table->string('ap_paterno');
            $table->string('ap_materno');
            $table->char('sexo');
            $table->date('fecha_nacimiento')->nullable();
            $table->string('domicilio');
            $table->char('grupo');
            $table->string('telefono');
            $table->string('correo');
            $table->integer('estado');
            $table->bigInteger('carrera_id')->unsigned();
            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}
