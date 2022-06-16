<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlteraEntrega extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('altera_entrega', function (Blueprint $table) {
            $table->id();
            $table->boolean('mes_1')->default(false);
            $table->boolean('mes_2')->default(false);
            $table->boolean('mes_3')->default(false);
            $table->boolean('mes_4')->default(false);
            $table->boolean('mes_5')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('altera_entrega;');
    }
}
