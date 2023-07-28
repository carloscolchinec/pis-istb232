<?php

namespace App\Http\Controllers\Emp;

use App\Http\Controllers\Controller;
use App\Models\UsuarioIngresoProducto;
use App\Models\UsuarioProveedores;
use Illuminate\Http\Request;


use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class ProveedoresIngresoProductosController extends Controller
{
    // Método para mostrar la lista de ingresos de productos
    public function index()
    {
        $cedula_ruc = session('user_data')['cedula_ruc'];
        $ingresosProductos = UsuarioIngresoProducto::with('proveedor')
            ->whereHas('proveedor', function ($query) use ($cedula_ruc) {
                $query->where('cedula_ruc', $cedula_ruc);
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('user.proveedor_ingreso_productos.index', compact('ingresosProductos'));
    }

    // Método para mostrar el formulario de creación de ingreso de productos
    public function create()
    {
        $cedula_ruc = session('user_data')['cedula_ruc'];
        $proveedores = UsuarioProveedores::where('cedula_ruc', $cedula_ruc)->get();
        return view('user.proveedor_ingreso_productos.create', compact('proveedores'));
    }

    // Método para almacenar un nuevo ingreso de productos en la base de datos
    public function store(Request $request)
    {
        try {
            // Obtenemos la cédula/ruc del usuario en sesión
            $cedula_ruc = session('user_data')['cedula_ruc'];
    
            // Validación de los campos requeridos
            $request->validate([
                'proveedor_id' => 'required|exists:tb_usuario_proveedores,id',
                'nombre_producto.*' => 'required|string',
                'precio_unitario.*' => 'required|numeric|min:0',
                'cantidad.*' => 'required|integer|min:1',
                'fecha_ingreso.*' => 'required|date',
            ]);
    
            // Crear el ingreso de productos
            foreach ($request->nombre_producto as $index => $nombre_producto) {
                UsuarioIngresoProducto::create([
                    'proveedor_id' => $request->input('proveedor_id'),
                    'nombre_producto' => $nombre_producto,
                    'precio_unitario' => $request->precio_unitario[$index],
                    'cantidad' => $request->cantidad[$index],
                    'fecha_ingreso' => $request->fecha_ingreso[$index],
                ]);
    
                // Actualizar la tabla tb_usuario_productos con el nuevo producto ingresado
                // Asumo que la categoría para ingreso es 1 (puedes cambiarlo si es diferente)
                $producto = [
                    'nombre_producto' => $nombre_producto,
                    'precio_unitario' => $request->precio_unitario[$index],
                    'stock' => $request->cantidad[$index],
                    'categoria' => 1,
                ];
                UsuarioProveedores::updateOrCreate(
                    ['cedula_ruc' => $cedula_ruc, 'nombre_producto' => $nombre_producto],
                    $producto
                );
            }
    
            return redirect()->route('enterprise.ingreso-productos.index')->with('success', 'Ingreso de productos registrado exitosamente.');
    
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error al procesar la solicitud: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error inesperado: ' . $e->getMessage())->withInput();
        }
    }


    // Método para mostrar los detalles de un ingreso de productos específico
    public function show($id)
    {
        $ingresoProducto = UsuarioIngresoProducto::findOrFail($id);
        return view('user.proveedor_ingreso_productos.show', compact('ingresoProducto'));
    }

    // Método para mostrar el formulario de edición de un ingreso de productos
    public function edit($id)
    {
        $ingresoProducto = UsuarioIngresoProducto::findOrFail($id);
        $proveedores = UsuarioProveedores::all();
        return view('user.proveedor_ingreso_productos.edit', compact('ingresoProducto', 'proveedores'));
    }

    // Método para actualizar un ingreso de productos en la base de datos
    public function update(Request $request, $id)
    {
        $cedula_ruc = session('user_data')['cedula_ruc'];

        // Validación de los campos requeridos
        $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'nombre_producto' => 'required|string',
            'precio_unitario' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:1',
            'fecha_ingreso' => 'required|date',
        ]);

        // Actualizar el ingreso de productos
        $ingresoProducto = UsuarioIngresoProducto::findOrFail($id);
        $ingresoProducto->update([
            'proveedor_id' => $request->proveedor_id,
            'nombre_producto' => $request->nombre_producto,
            'precio_unitario' => $request->precio_unitario,
            'cantidad' => $request->cantidad,
            'fecha_ingreso' => $request->fecha_ingreso,
        ]);

        // Actualizar la tabla tb_usuario_productos con los cambios en el producto
        // Asumo que la categoría para ingreso es 1 (puedes cambiarlo si es diferente)
        $producto = [
            'cedula_ruc' => $cedula_ruc,
            'nombre_producto' => $request->nombre_producto,
            'precio_unitario' => $request->precio_unitario,
            'stock' => $request->cantidad,
            'categoria' => 1,
        ];
        UsuarioProveedores::updateOrCreate(['nombre_producto' => $request->nombre_producto], $producto);

        return redirect()->route('ingreso-productos.index')->with('success', 'Ingreso de productos actualizado exitosamente.');
    }

    // Método para eliminar un ingreso de productos de la base de datos
    public function destroy($id)
    {
        UsuarioIngresoProducto::findOrFail($id)->delete();
        return redirect()->route('enterprise.ingreso-productos.index')->with('success', 'Ingreso de productos eliminado exitosamente.');
    }
}
