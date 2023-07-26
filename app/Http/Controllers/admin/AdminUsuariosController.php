<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminUsuarios;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash; // Importa la clase Hash


class AdminUsuariosController extends Controller
{
    // Método para mostrar la lista de perfiles de usuario
    public function index()
    {
        $perfiles = AdminUsuarios::all();
        return view('admin.usuarios.index', compact('perfiles'));
    }

    // Método para mostrar el formulario de creación de perfiles de usuario
    public function create()
    {
        return view('admin.usuarios.create');
    }

    // Método para almacenar un nuevo perfil de usuario en la base de datos
    public function store(Request $request)
    {
        try {
            $request->validate([
                'cedula_ruc' => 'required|string|unique:tb_Usuario_Default',
                'tipo_cliente' => 'required|string',
                'nombre' => 'required|string',
                'apellido' => 'required|string',
                'email' => 'required|email|unique:tb_Usuario_Default',
                'password' => 'required|string',
                'telefono' => 'required|string',
                'direccion' => 'required|string',
                'fecha_nacimiento' => 'required|date',
                'estado' => 'required|boolean',
            ]);
    
            // Encripta la contraseña antes de guardarla
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
    
            AdminUsuarios::create($data);
    
            return redirect()->route('admin.usuarios.index')->with('success', 'Perfil de usuario creado exitosamente.');
        } catch (\Exception $e) {
            // En caso de error, puedes mostrar un mensaje de error o redirigir a una página de error
            return redirect()->back()->withErrors('Error, el RUC ya se encuentra registrado');
        }
    }


    // Método para mostrar los detalles de un perfil de usuario específico
    public function show(AdminUsuarios $perfil)
    {
        return view('admin.usuarios.show', compact('perfil'));
    }

    // Método para mostrar el formulario de edición de un perfil de usuario
    public function edit(AdminUsuarios $perfil)
    {
        return view('admin.usuarios.edit', compact('perfil'));
    }

    // Método para actualizar un perfil de usuario en la base de datos
    public function update(Request $request, AdminUsuarios $perfil)
    {
        try {
            $request->validate([
                'cedula_ruc' => 'required|string|unique:tb_Usuario_Default,cedula_ruc,' . $perfil->id_cliente . ',id_cliente',
                'tipo_cliente' => 'required|string',
                'nombre' => 'required|string',
                'apellido' => 'required|string',
                'email' => 'required|email|unique:tb_Usuario_Default,email,' . $perfil->id_cliente . ',id_cliente',
                'password' => 'required|string',
                'telefono' => 'required|string',
                'direccion' => 'required|string',
                'fecha_nacimiento' => 'required|date',
                'estado' => 'required|boolean',
            ]);

            $data = $request->all();

            // Si se proporcionó una nueva contraseña, actualiza el campo "password"
            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']); // Si no se proporcionó una contraseña nueva, no se actualiza el campo "password"
            }

            $perfil->update($data);
            return redirect()->route('admin.usuarios.index')->with('success', 'Perfil de usuario actualizado exitosamente.');
        } catch (\Exception $e) {
            // En caso de error, puedes mostrar un mensaje de error o redirigir a una página de error
            return redirect()->back()->withErrors('Error al actualizar el perfil de usuario: ' . $e->getMessage());
        }
    }


    // Método para eliminar un perfil de usuario de la base de datos
    public function destroy(AdminUsuarios $perfil)
    {
        $perfil->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Perfil de usuario eliminado exitosamente.');
    }
}
