<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOnCascadePeriodoTutorado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('periodo_tutorado', function (Blueprint $table) {
            // Elimina la clave foránea existente
            $table->dropForeign(['alumno_id']);

            // Vuelve a agregar la clave foránea con ON UPDATE CASCADE
            $table->foreign('alumno_id')
                  ->references('id')
                  ->on('alumnos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');  // Agregar la opción ON UPDATE CASCADE
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('periodo_tutorado', function (Blueprint $table) {
            // Elimina la clave foránea modificada
            $table->dropForeign(['alumno_id']);

            // Vuelve a agregar la clave foránea original sin ON UPDATE CASCADE
            $table->foreign('alumno_id')
                  ->references('id')
                  ->on('alumnos')
                  ->onDelete('cascade');
        });
    }
}
