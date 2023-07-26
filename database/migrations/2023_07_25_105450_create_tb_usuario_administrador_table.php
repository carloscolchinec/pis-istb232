<?php
// create_tb_usuario_administrador_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUsuarioAdministradorTable extends Migration
{
    public function up()
    {
        Schema::create('tb_Usuario_Administrador', function (Blueprint $table) {
            $table->id('id_admin')->primary;
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cedula');
            $table->string('email');
            $table->string('password');
            $table->date('fecha_nacimiento');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_Usuario_Administrador');
    }
}
