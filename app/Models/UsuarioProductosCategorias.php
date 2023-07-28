<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioProductosCategorias extends Model
{
    protected $table = 'tb_usuario_productos_categorias';
    protected $primaryKey = 'id_categoria';
    protected $fillable = ['nombre_categoria', 'cedula_ruc'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id');
    }
}
