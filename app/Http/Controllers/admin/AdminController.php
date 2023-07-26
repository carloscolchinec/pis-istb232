<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUsuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdminController extends Controller
{
    public function dashboard() 
    {
        $clientesActivos = AdminUsuarios::where('estado', 1)->count();
        return view('admin.dashboard.index', compact('clientesActivos'));
    }
}
