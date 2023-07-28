<?php

namespace App\Http\Controllers\emp;

use App\Http\Controllers\Controller;
use App\Models\UsuarioProductos;
use App\Models\UsuarioProductosCategorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientesProductosCategoriasController extends Controller
{
    public function index()
    {
        $cedula_ruc = session('user_data')['cedula_ruc']; 
    
        $categorias = UsuarioProductosCategorias::where('cedula_ruc', $cedula_ruc)->get();
    
        // Obtener la cantidad de productos por categoría y almacenarla en un arreglo asociativo
        $cantidadProductosPorCategoria = [];
        foreach ($categorias as $categoria) {
            $cantidadProductos = UsuarioProductos::where('cedula_cliente', $cedula_ruc)
                ->where('categoria_id', $categoria->id_categoria)
                ->count();
            $cantidadProductosPorCategoria[$categoria->id_categoria] = $cantidadProductos;
        }
    
        return view('user.categorias.index', compact('categorias', 'cantidadProductosPorCategoria'));
    }

    public function create()
    {
        return view('user.categorias.create');
    }

    public function store(Request $request)
    {
        // Session
        $cedula_ruc = session('user_data')['cedula_ruc']; 

        $request->validate([
            'nombre_categoria' => 'required|string|unique:tb_Usuario_Productos_Categorias',
        ]);

        $data = $request->all();
        $data['cedula_ruc'] = $cedula_ruc;

        UsuarioProductosCategorias::create($data);

        return redirect()->route('enterprise.categorias.index')->with('success', 'Categoría creada exitosamente.');
    }

    public function show(UsuarioProductosCategorias $categoria)
    {
        return view('user.categorias.show', compact('categoria'));
    }

    public function edit(UsuarioProductosCategorias $categoria)
    {
        return view('user.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, UsuarioProductosCategorias $categoria)
    {
        $cedula_ruc = session('user_data')['cedula_ruc']; 

        $request->validate([
            'nombre_categoria' => 'required|string|unique:tb_Usuario_Productos_Categorias,nombre_categoria,' . $categoria->id_categoria . ',id_categoria,cedula_ruc,' . $cedula_ruc,
        ]);

        $categoria->update($request->all());

        return redirect()->route('enterprise.categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    public function destroy(UsuarioProductosCategorias $categoria)
    {
        $categoria->delete();
        return redirect()->route('enterprise.categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
