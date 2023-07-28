<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioClientes extends Model
{
    use HasFactory;

    protected $table = 'tb_usuario_clientes'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'id_cliente'; // Nombre de la clave primaria en la tabla

    protected $fillable = [
        'cedula_cliente',
        'id_empresa', // Asegúrate de que este campo esté en la migración
        'nombre',
        'apellido',
        'email',
        'telefono',
        'direccion',
        'fecha_nacimiento',
    ];

}
