<?php

namespace App\Http\Controllers\emp;


use App\Http\Controllers\Controller;
use App\Models\UsuarioProductos;
use App\Models\UsuarioProductosCategorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importamos la clase Auth

class ClientesProductosController extends Controller
{
    public function index()
    {
        // Obtenemos la cédula_ruc de la sesión
        $cedula_ruc = session('user_data')['cedula_ruc'];

        // Obtenemos solo las categorías relacionadas con la cédula_ruc
        $categorias = UsuarioProductosCategorias::where('cedula_ruc', $cedula_ruc)->get();

        // Obtenemos los productos relacionados con la cédula_ruc y la categoría
        $productos = UsuarioProductos::where('cedula_cliente', $cedula_ruc)->get();

        return view('user.productos.index', compact('categorias', 'productos'));
    }

    public function create()
    {
        // Obtenemos la cédula_ruc de la sesión
        $cedula_ruc = session('user_data')['cedula_ruc'];

        // Obtenemos solo las categorías relacionadas con la cédula_ruc para el formulario de creación
        $categorias = UsuarioProductosCategorias::where('cedula_ruc', $cedula_ruc)->get();

        return view('user.productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        // Validamos la cédula_ruc de la sesión
        $cedula_ruc = session('user_data')['cedula_ruc'];
    
        $request->validate([
            'codigo_producto' => 'required|string|unique:tb_Usuario_Productos',
            'nombre_producto' => 'required|string',
            'descripcion_producto' => 'required|string',
            'fecha_de_caducidad' => 'required|date',
            'stock_producto' => 'required|integer',
            'precio_unitario' => 'required|numeric', // Agregamos la validación para el precio unitario
            'categoria_id' => 'required|exists:tb_Usuario_Productos_Categorias,id_categoria',
        ]);
    
        // Agregamos la cédula_ruc del usuario al request antes de crear el producto
        $data = $request->all();
        $data['cedula_cliente'] = $cedula_ruc;
    
        UsuarioProductos::create($data);
    
        return redirect()->route('enterprise.productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function show(UsuarioProductos $producto)
    {
        // Validamos que el producto pertenezca al usuario logueado (por si alguien intenta acceder por URL)
        if ($producto->cedula_cliente !== session('user_data')['cedula_ruc']) {
            return redirect()->route('enterprise.productos.index')->with('error', 'Producto no encontrado.');
        }

        return view('user.productos.show', compact('producto'));
    }

    public function edit(UsuarioProductos $producto)
    {
        // Validamos que el producto pertenezca al usuario logueado (por si alguien intenta acceder por URL)
        if ($producto->cedula_cliente !== session('user_data')['cedula_ruc']) {
            return redirect()->route('enterprise.productos.index')->with('error', 'Producto no encontrado.');
        }

        // Obtenemos solo las categorías relacionadas con la cédula_ruc para el formulario de edición
        $categorias = UsuarioProductosCategorias::where('cedula_ruc', session('user_data')['cedula_ruc'])->get();

        return view('user.productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, UsuarioProductos $producto)
    {
        // Validamos que el producto pertenezca al usuario logueado (por si alguien intenta acceder por URL)
        if ($producto->cedula_cliente !== session('user_data')['cedula_ruc']) {
            return redirect()->route('enterprise.productos.index')->with('error', 'Producto no encontrado.');
        }
    
        $request->validate([
            'codigo_producto' => 'required|string|unique:tb_Usuario_Productos,codigo_producto,' . $producto->id_producto . ',id_producto',
            'nombre_producto' => 'required|string',
            'descripcion_producto' => 'required|string',
            'fecha_de_caducidad' => 'required|date',
            'stock_producto' => 'required|integer',
            'precio_unitario' => 'required|numeric', // Agregamos la validación para el precio unitario
            'categoria_id' => 'required|exists:tb_Usuario_Productos_Categorias,id_categoria',
        ]);
    
        $producto->update($request->all());
    
        return redirect()->route('enterprise.productos.index')->with('success', 'Producto actualizado exitosamente.');
    }
    

    public function destroy(UsuarioProductos $producto)
    {
        // Validamos que el producto pertenezca al usuario logueado (por si alguien intenta acceder por URL)
        if ($producto->cedula_cliente !== session('user_data')['cedula_ruc']) {
            return redirect()->route('enterprise.productos.index')->with('error', 'Producto no encontrado.');
        }

        $producto->delete();
        return redirect()->route('enterprise.productos.index')->with('success', 'Producto eliminado exitosamente.');
    }


}
