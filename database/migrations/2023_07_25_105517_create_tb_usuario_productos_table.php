<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUsuarioProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_Usuario_Productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('codigo_producto');
            $table->string('nombre_producto');
            $table->text('descripcion_producto');
            $table->date('fecha_de_caducidad');
            $table->integer('stock_producto');
            $table->unsignedBigInteger('categoria_id');
            $table->timestamps();

            // Definimos la relación con la tabla tb_Usuario_Productos_Categorias
            $table->foreign('categoria_id')->references('id_categoria')->on('tb_Usuario_Productos_Categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_Usuario_Productos');
    }
}
