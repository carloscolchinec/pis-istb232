<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UsuarioDefault extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'tb_usuario_default'; // Nombre de la tabla en la base de datos


    protected $fillable = [
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

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
