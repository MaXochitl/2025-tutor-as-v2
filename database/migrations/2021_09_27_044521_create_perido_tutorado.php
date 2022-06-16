<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeridoTutorado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodo_tutorado', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('periodo_id')->unsigned();
            $table->string('tutor_id');
            $table->string('alumno_id');
            $table->integer('semestre');
            $table->integer('tipo');
            $table->string('mes_1')->nullable();
            $table->string('mes_2')->nullable();
            $table->string('mes_3')->nullable();
            $table->string('mes_4')->nullable();
            $table->string('reporte_final')->nullable();
            $table->string('oe_1')->nullable();
            $table->string('oe_2')->nullable();
            $table->string('oe_3')->nullable();
            $table->string('oe_4')->nullable();
            $table->date('entrega_1')->nullable();
            $table->date('entrega_2')->nullable();
            $table->date('entrega_3')->nullable();
            $table->date('entrega_4')->nullable();
            $table->date('entrega_final')->nullable();
            $table->integer('status');
            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('cascade');
            $table->foreign('tutor_id')->references('id')->on('tutores')->onDelete('cascade');
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periodo_tutorado');
    }
}
