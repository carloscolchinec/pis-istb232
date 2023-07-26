<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUsuarioDefaultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_Usuario_Default', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('cedula_ruc')->unique();
            $table->string('tipo_cliente');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email');
            $table->string('password');
            $table->string('telefono');
            $table->string('direccion');
            $table->date('fecha_nacimiento');
            $table->boolean('estado')->default(true); // Activo = true, Inactivo = false
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
        Schema::dropIfExists('tb_Usuario_Default');
    }
}
