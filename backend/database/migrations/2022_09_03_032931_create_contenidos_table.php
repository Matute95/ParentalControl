<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContenidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenidos', function (Blueprint $table) {
            $table->id();
            $table->datetime('fecha');
            $table->String('path');
            $table->String('url');
            $table->String('tipo_contenido'); //PAREN NAME De AWS
            $table->String('contenido'); // NAME de AWS
            // $table->foreignId('categoria_id');
            $table->foreignId('hijo_id');
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
        Schema::dropIfExists('contenidos');
    }
}
