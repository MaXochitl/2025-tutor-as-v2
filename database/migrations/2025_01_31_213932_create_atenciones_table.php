<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('atenciones', function (Blueprint $table) {
            $table->id();
            $table->string('alumno_id', 255)->collation('utf8mb4_unicode_ci');
            $table->string('atencion', 255);
            $table->string('canalizado', 255)->nullable();
            $table->string('area_canalizada', 255)->nullable();
            $table->unsignedBigInteger('periodo_id')->nullable();

            // Foreign keys
            $table->foreign('alumno_id', 'fk_alumno_id')
                  ->references('id')
                  ->on('alumnos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('periodo_id', 'fk_periodo_id')
                  ->references('id')
                  ->on('periodos')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atenciones');
    }
};