<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UsuarioAdministrador extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "tb_usuario_administrador";


    protected $primaryKey = 'id_admin'; // Definimos la columna "id_admin" como clave primaria

    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'email',
        'password',
        'fecha_nacimiento',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
