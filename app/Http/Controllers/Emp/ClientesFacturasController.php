<?php

namespace App\Http\Controllers\Emp;

use App\Http\Controllers\Controller;
use App\Models\UsuarioClientes;
use App\Models\UsuarioFactura;
use App\Models\UsuarioProductos;
use App\Models\UsuarioDetallesFactura;
use Illuminate\Http\Request;



class ClientesFacturasController extends Controller
{
    // Método para mostrar la lista de facturas del usuario en sesión
    public function index()
    {
        $cedula_ruc = session('user_data')['cedula_ruc'];
        $facturas = UsuarioFactura::where('cedula_ruc', $cedula_ruc)->get();
        return view('user.facturas.index', compact('facturas'));
    }

    // Método para mostrar el formulario de creación de factura
    public function create()
    {
        $cedula_ruc = session('user_data')['cedula_ruc'];
        $productos = UsuarioProductos::where('cedula_cliente', $cedula_ruc)->get();
        $clientes = UsuarioClientes::where('id_empresa', $cedula_ruc)->get();
        return view('user.facturas.create', compact('productos', 'clientes'));
    }

    // Método para almacenar una nueva factura en la base de datos
public function store(Request $request)
{
    // Validación de los campos requeridos
    $request->validate([
        'cedula_cliente' => 'required|string',
        'total_factura' => 'required|numeric|min:0',
        'fecha_factura' => 'required|date',
        'nombre_producto.*' => 'required|string',
        'precio_producto.*' => 'required|numeric|min:0',
        'stock_producto.*' => 'required|integer|min:0',
    ]);

    // Obtenemos la cédula/ruc del usuario en sesión
    $cedula_ruc = session('user_data')['cedula_ruc'];

    // Creamos la nueva factura asociada al usuario en sesión
    $factura = UsuarioFactura::crearFactura(
        $cedula_ruc,
        $request->cedula_cliente,
        $request->total_factura,
        $request->fecha_factura
    );

    // Obtenemos los detalles de la factura (productos) y los almacenamos
    foreach ($request->nombre_producto as $index => $nombre_producto) {
        // Crear el detalle de la factura asociado a la factura creada
        $detalleFactura = UsuarioDetallesFactura::create([
            'cedula_ruc' => $cedula_ruc,
            'factura_id' => $factura->id_factura,
            'nombre_producto' => $nombre_producto,
            'precio_producto' => $request->precio_producto[$index],
            'stock_producto' => -$request->stock_producto[$index], // Disminuir el stock
        ]);

        // Actualizar el stock del producto
        $producto = UsuarioProductos::where('cedula_cliente', $cedula_ruc)
            ->where('nombre_producto', $nombre_producto)
            ->first();

        if ($producto) {
            $producto->stock_producto -= $request->stock_producto[$index];
            $producto->save();
        }
    }

    return redirect()->route('enterprise.facturas.index')->with('success', 'Factura creada exitosamente.');
}



    // Método para mostrar los detalles de una factura específica
    public function show($id)
    {
        $factura = UsuarioFactura::findOrFail($id);
        $detallesFactura = UsuarioDetallesFactura::obtenerDetallesFactura($id);
        return view('user.facturas.show', compact('factura', 'detallesFactura'));
    }

    // Método para mostrar el formulario de edición de una factura
    public function edit($id)
    {
        $factura = UsuarioFactura::findOrFail($id);
        $detallesFactura = UsuarioDetallesFactura::obtenerDetallesFactura($id);
        return view('user.facturas.edit', compact('factura', 'detallesFactura'));
    }

    // Método para actualizar una factura en la base de datos
    public function update(Request $request, $id)
    {
        $factura = UsuarioFactura::findOrFail($id);
    
        // Validación de los campos requeridos
        $request->validate([
            'cedula_cliente' => 'required|string',
            'total_factura' => 'required|numeric|min:0',
            'fecha_factura' => 'required|date',
            'nombre_producto.*' => 'required|string',
            'precio_producto.*' => 'required|numeric|min:0',
            'stock_producto.*' => 'required|integer|min:0',
        ]);
    
        // Actualizamos los datos de la factura
        $factura->update([
            'cedula_cliente' => $request->cedula_cliente,
            'total_factura' => $request->total_factura,
            'fecha_factura' => $request->fecha_factura,
        ]);
    
        // Eliminamos los detalles de factura existentes
        UsuarioDetallesFactura::where('factura_id', $id)->delete();
        $cedula_ruc = session('user_data')['cedula_ruc'];

        // Agregamos los nuevos detalles de factura
        foreach ($request->nombre_producto as $index => $nombre_producto) {
            UsuarioDetallesFactura::crearDetalleFactura(
                $factura->cedula_ruc,
                $id, // Asignamos el ID de la factura aquí
                $nombre_producto,
                $request->precio_producto[$index],
                $request->stock_producto[$index]
            );
    
            // Obtener la diferencia en el stock

            

            $producto = UsuarioProductos::where('cedula_cliente', $cedula_ruc)
                ->where('nombre_producto', $nombre_producto)
                ->first();
    
            if ($producto) {
                $diferenciaStock = $request->stock_producto[$index] - $factura->detallesFactura[$index]->stock_producto;
                $producto->stock_producto += $diferenciaStock;
                $producto->save();
            }
        }
    
        return redirect()->route('enterprise.facturas.index')->with('success', 'Factura actualizada exitosamente.');
    }
    
    // Método para eliminar una factura de la base de datos
    public function destroy($id)
{
    // Buscar la factura por su ID
    $factura = UsuarioFactura::findOrFail($id);

    // Obtener los detalles de la factura
    $detallesFactura = UsuarioDetallesFactura::where('factura_id', $id)->get();

    // Restaurar el stock de los productos
    foreach ($detallesFactura as $detalle) {
        $producto = UsuarioProductos::where('cedula_cliente', $factura->cedula_ruc)
            ->where('nombre_producto', $detalle->nombre_producto)
            ->first();

        if ($producto) {
            $producto->stock_producto += $detalle->stock_producto;
            $producto->save();
        }
    }

    // Eliminar los detalles de la factura asociados
    UsuarioDetallesFactura::where('factura_id', $factura->id_factura)->delete();

    // Eliminar la factura
    $factura->delete();

    return redirect()->route('enterprise.facturas.index')->with('success', 'Factura eliminada exitosamente.');
}

    
    
  
}
