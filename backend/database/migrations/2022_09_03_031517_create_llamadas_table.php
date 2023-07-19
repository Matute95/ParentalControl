<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLlamadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('llamadas', function (Blueprint $table) {
            $table->id();
            $table->boolean('aceptada');
            $table->dateTime('fecha');
            $table->String('tiempo');
            $table->foreignId('contacto_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('llamadas');
    }
}
