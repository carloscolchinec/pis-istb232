<?php

namespace App\Http\Controllers\emp;

use App\Http\Controllers\Controller;

use App\Models\UsuarioProveedores;
use Illuminate\Http\Request;


class ClientesProveedoresController extends Controller
{
    // Mostrar la lista de proveedores
    public function index()
    {
        $cedula_ruc = session('user_data')['cedula_ruc'];
        $proveedores = UsuarioProveedores::where('cedula_ruc', $cedula_ruc)->get();
        return view('user.proveedores.index', compact('proveedores'));
    }

    // Mostrar el formulario de creación de proveedores
    public function create()
    {
        return view('user.proveedores.create');
    }

    // Almacenar un nuevo proveedor en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'identificador_ruc' => 'required|string|unique:tb_usuario_proveedores',
            'nombre_empresa' => 'required|string',
            'telefono' => 'required|string',
            'ciudad_proveedor' => 'required|string',
        ]);

        $cedula_ruc = session('user_data')['cedula_ruc'];
        UsuarioProveedores::create([
            'nombre' => $request->nombre,
            'cedula_ruc' => $cedula_ruc,
            'identificador_ruc' => $request->identificador_ruc,
            'nombre_empresa' => $request->nombre_empresa,
            'telefono' => $request->telefono,
            'ciudad_proveedor' => $request->ciudad_proveedor,
        ]);

        return redirect()->route('enterprise.proveedores.index')->with('success', 'Proveedor creado exitosamente.');
    }

    // Mostrar los detalles de un proveedor específico
    public function show($id)
    {
        $proveedor = UsuarioProveedores::findOrFail($id);
        return view('user.proveedores.show', compact('proveedor'));
    }

    // Mostrar el formulario de edición de un proveedor
    public function edit($id)
    {
        $proveedor = UsuarioProveedores::findOrFail($id);
        return view('user.proveedores.edit', compact('proveedor'));
    }

    // Actualizar un proveedor en la base de datos
    public function update(Request $request, $id)
    {
        $proveedor = UsuarioProveedores::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string',
            'identificador_ruc' => 'required|string|unique:tb_usuario_proveedores,identificador_ruc,' . $id,
            'nombre_empresa' => 'required|string',
            'telefono' => 'required|string',
            'ciudad_proveedor' => 'required|string',
        ]);

        $cedula_ruc = session('user_data')['cedula_ruc'];


        $proveedor->update([
            'nombre' => $request->nombre,
            'cedula_ruc' => $cedula_ruc,
            'identificador_ruc' => $request->identificador_ruc,
            'nombre_empresa' => $request->nombre_empresa,
            'telefono' => $request->telefono,
            'ciudad_proveedor' => $request->ciudad_proveedor,
        ]);

        return redirect()->route('enterprise.proveedores.index')->with('success', 'Proveedor actualizado exitosamente.');
    }

    // Eliminar un proveedor de la base de datos
    public function destroy($id)
    {
        $proveedor = UsuarioProveedores::findOrFail($id);
        $proveedor->delete();

        return redirect()->route('enterprise.proveedores.index')->with('success', 'Proveedor eliminado exitosamente.');
    }
}
