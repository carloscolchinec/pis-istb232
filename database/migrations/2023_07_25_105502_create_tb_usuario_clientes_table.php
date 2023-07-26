<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUsuarioClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_Usuario_Clientes', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('cedula_cliente')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email');
            $table->string('telefono');
            $table->string('direccion');
            $table->date('fecha_nacimiento');
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
        Schema::dropIfExists('tb_Usuario_Clientes');
    }
}
