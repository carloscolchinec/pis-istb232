<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_Usuario_IngresoProductos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proveedor_id');
            $table->string('nombre_producto');
            $table->float('precio_unitario');
            $table->integer('cantidad');
            $table->date('fecha_ingreso'); 
            $table->timestamps();
            $table->foreign('proveedor_id')->references('id')->on('tb_usuario_proveedores')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_Usuario_IngresoProductos');
    }
};
