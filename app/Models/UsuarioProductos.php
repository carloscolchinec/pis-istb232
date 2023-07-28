<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioProductos extends Model
{
    use HasFactory;

    protected $table = 'tb_Usuario_Productos';
    protected $primaryKey = 'id_producto';
    protected $fillable = [
        'cedula_cliente',
        'codigo_producto',
        'nombre_producto',
        'precio_unitario',
        'descripcion_producto',
        'fecha_de_caducidad',
        'stock_producto',
        'categoria_id',
    ];

    // Relación con la tabla tb_Usuario_Productos_Categorias
    public function categoria()
    {
        return $this->belongsTo(UsuarioProductosCategorias::class, 'categoria_id', 'id_categoria');
    }
}
