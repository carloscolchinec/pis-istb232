<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioIngresoProducto extends Model
{
    use HasFactory;

    protected $table = 'tb_usuario_ingresoproductos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'proveedor_id',
        'nombre_producto',
        'precio_unitario',
        'cantidad',
        'fecha_ingreso',
    ];

    // Relación con el modelo Proveedor
    public function proveedor()
    {
        return $this->belongsTo(UsuarioProveedores::class, 'proveedor_id');
    }

    // Relación con el modelo Producto
    public function productos()
    {
        return $this->hasMany(UsuarioProducto::class, 'ingreso_producto_id');
    }
}
