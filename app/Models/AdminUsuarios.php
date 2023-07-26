<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUsuarios extends Model
{
    use HasFactory;

    protected $table = 'tb_usuario_default'; // Nombre de la tabla en la base de datos

    
    protected $primaryKey = 'id_cliente';


    protected $fillable = [
        'id_cliente',
        'cedula_ruc',
        'tipo_cliente',
        'nombre',
        'apellido',
        'email',
        'password',
        'telefono',
        'direccion',
        'fecha_nacimiento',
        'estado',
    ];

    // Agrega más relaciones o métodos aquí si es necesario
}
