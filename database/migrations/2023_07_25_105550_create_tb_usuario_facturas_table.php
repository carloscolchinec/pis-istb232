<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUsuarioFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_Usuario_Facturas', function (Blueprint $table) {
            $table->id('id_factura');
            $table->string('cedula_cliente');
            $table->double('total_factura', 8, 2);
            $table->date('fecha_factura');
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
        Schema::dropIfExists('tb_Usuario_Facturas');
    }
}
