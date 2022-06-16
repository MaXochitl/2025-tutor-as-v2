<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileFormat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_format', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_archivo');
            $table->string('destinatario');
            $table->string('atentamente_1');
            $table->string('cargo');
            $table->string('atentamente_2');
            $table->string('cargo_2');
            $table->string('atentamente_3');
            $table->string('cargo_3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_format');
    }
}
