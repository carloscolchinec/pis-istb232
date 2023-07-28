<?php

namespace App\Http\Controllers\emp;

use App\Models\UsuarioClientes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientesController extends Controller
{
    // Mostrar la lista de clientes
    public function index()
    {
        $cedula_ruc = session('user_data')['cedula_ruc']; // Obtener el cedula_ruc del usuario logueado
        $clientes = UsuarioClientes::where('id_empresa', $cedula_ruc)->get(); // Filtrar los clientes por el cedula_ruc del usuario logueado
        return view('user.clientes.index', compact('clientes'));
    }
    

    // Mostrar el formulario para agregar un nuevo cliente
    public function create()
    {

        return view('user.clientes.create');
   
    }


    public function store(Request $request)
    {
        $request->validate([
            'cedula_cliente' => 'required|string|unique:tb_Usuario_Clientes',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email|unique:tb_Usuario_Clientes',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'fecha_nacimiento' => 'required|date',
        ]);
    
        $data = $request->all();
        $data['id_empresa'] = session('user_data')['cedula_ruc'];
        // Asignar el id_empresa con el ID del usuario autenticado
    
        $cliente = UsuarioClientes::create($data);
    
        if ($cliente) {
            return redirect()->route('enterprise.clientes.index')->with('success', 'Cliente agregado exitosamente.');
        } else {
            return back()->withInput()->with('error', 'Error al agregar el cliente.');
        }
    }
    
    // Mostrar el formulario para editar un cliente existente
    public function edit($id)
    {
        $cliente = UsuarioClientes::findOrFail($id);
        return view('user.clientes.edit', compact('cliente'));
    }

    // Actualizar los datos del cliente en la base de datos
    public function update(Request $request, $id)
    {
        $cliente = UsuarioClientes::find($id);
    
        if (!$cliente) {
            // Si el cliente no existe, redirigir con un mensaje de error
            return redirect()->route('enterprise.clientes.index')->with('error', 'Cliente no encontrado.');
        }
    
        $request->validate([
            'cedula_cliente' => 'required|string|unique:tb_Usuario_Clientes,cedula_cliente,' . $cliente->id_cliente . ',id_cliente',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email|unique:tb_Usuario_Clientes,email,' . $cliente->id_cliente . ',id_cliente',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'fecha_nacimiento' => 'required|date',
        ]);
    
        $data = $request->all();
        $data['id_empresa'] = session('user_data')['cedula_ruc'];
        // Asignar el id_empresa con el ID del usuario autenticado
    
        $cliente->update($data);
    
        return redirect()->route('enterprise.clientes.index')->with('success', 'Cliente actualizado exitosamente.');
    }
    

    // Mostrar los detalles de un cliente
    public function show($id)
    {
        $cliente = UsuarioClientes::findOrFail($id);
        return view('user.clientes.show', compact('cliente'));
    }

    // Eliminar un cliente de la base de datos
    public function destroy($id)
    {
        $cliente = UsuarioClientes::findOrFail($id);
        $cliente->delete();

        return redirect()->route('enterprise.clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
