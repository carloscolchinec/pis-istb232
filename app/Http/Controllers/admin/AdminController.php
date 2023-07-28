<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUsuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; // Importamos la clase Auth

class AdminController extends Controller
{
    public function dashboard() 
    {
        // Verificar si no hay una sesión activa para el guard 'admin'
        if (!Auth::guard('admin')->check()) {
            return view('admin.login.index');
        }

        $clientesActivos = AdminUsuarios::where('estado', 1)->count();
        return view('admin.dashboard.index', compact('clientesActivos'));
    }
}
