<?php

// app/Models/UsuarioFactura.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioFactura extends Model
{
    protected $table = 'tb_Usuario_Facturas';
    protected $primaryKey = 'id_factura';

    protected $fillable = [
        'cedula_ruc',
        'cedula_cliente',
        'total_factura',
        'fecha_factura',
    ];

    // Relación uno a muchos con el modelo UsuarioDetallesFactura
    public function detallesFacturas()
    {
        return $this->hasMany(UsuarioDetallesFactura::class, 'factura_id', 'id_factura');
    }

    // Método para crear una nueva factura asociada al usuario en sesión
    public static function crearFactura($cedula_ruc, $cedula_cliente, $total_factura, $fecha_factura)
    {
        return self::create([
            'cedula_ruc' => $cedula_ruc,
            'cedula_cliente' => $cedula_cliente,
            'total_factura' => $total_factura,
            'fecha_factura' => $fecha_factura,
        ]);
    }

    // Método para obtener todas las facturas asociadas al usuario en sesión
    public static function obtenerFacturasUsuario()
    {
        $cedula_ruc = session('user_data')['cedula_ruc'];
        return self::where('cedula_ruc', $cedula_ruc)->get();
    }
}
