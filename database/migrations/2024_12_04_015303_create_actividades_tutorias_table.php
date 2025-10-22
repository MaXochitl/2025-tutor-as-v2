<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesTutoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_tutorias', function (Blueprint $table) {
            $table->id(); 
            $table->string('tema');
            $table->text('descripcion_actividad');
            $table->date('fecha');
            $table->time('tiempo');
            $table->string('recursos');
            $table->string('tutor_id'); 

            $table->timestamps();

            // CLAVE FORANEA
            $table->foreign('tutor_id')->references('id')->on('tutores')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividades_tutorias');
    }
}
