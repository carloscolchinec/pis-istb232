<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUsuarioDetallesFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_Usuario_DetallesFacturas', function (Blueprint $table) {
            $table->id('id_DetallesFacturas');
            $table->string('cedula_ruc');
            $table->unsignedBigInteger('factura_id');
            $table->string('nombre_producto');
            $table->double('precio_producto', 8, 2);
            $table->integer('stock_producto');
            $table->timestamps();

            // Definimos la relación con la tabla tb_Usuario_Facturas
            $table->foreign('factura_id')->references('id_factura')->on('tb_Usuario_Facturas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_Usuario_DetallesFacturas');
    }
}
