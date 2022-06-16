<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutores', function (Blueprint $table) {
           // $table->bigIncrements('id');
            $table->string('id')->primary();
            $table->bigInteger('carrera_id')->nullable()->unsigned();
            $table->string('nombre');
            $table->string('ap_paterno');
            $table->string('ap_materno');            
            $table->char('sexo');
            $table->string('telefono');
            $table->string('domicilio');
            $table->string('foto')->nullable(); 
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
        Schema::dropIfExists('tutores');
    }
}
