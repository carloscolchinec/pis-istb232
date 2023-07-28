<?php

// app/Models/UsuarioDetallesFactura.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioDetallesFactura extends Model
{
    protected $table = 'tb_Usuario_DetallesFacturas';
    protected $primaryKey = 'id_DetallesFacturas';

    protected $fillable = [
        'cedula_ruc',
        'factura_id',
        'nombre_producto',
        'precio_producto',
        'stock_producto',
    ];

    // Relación inversa con el modelo UsuarioFactura
    public function factura()
    {
        return $this->belongsTo(UsuarioFactura::class, 'factura_id', 'id_factura');
    }

    // Método para crear un nuevo detalle de factura asociado a una factura
    public static function crearDetalleFactura($factura_id, $nombre_producto, $precio_producto, $stock_producto)
    {
        return self::create([
            'factura_id' => $factura_id,
            'nombre_producto' => $nombre_producto,
            'precio_producto' => $precio_producto,
            'stock_producto' => $stock_producto,
        ]);
    }

    // Método para obtener todos los detalles de facturas asociados a una factura específica
    public static function obtenerDetallesFactura($factura_id)
    {
        return self::where('factura_id', $factura_id)->get();
    }
}
