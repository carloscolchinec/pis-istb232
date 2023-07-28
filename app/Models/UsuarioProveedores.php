<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioProveedores extends Model
{
    use HasFactory;

    protected $table = "tb_usuario_proveedores";

    protected $fillable = [
        'nombre',
        'cedula_ruc',
        'identificador_ruc',
        'nombre_empresa',
        'telefono',
        'ciudad_proveedor',
    ];

    public function ingresoProductos()
    {
        return $this->hasMany(IngresoProducto::class, 'proveedor_id');
    }
}
