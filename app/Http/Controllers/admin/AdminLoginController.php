<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importamos la clase Auth
use App\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
    protected $redirectTo = '/admin/dashboard'; // Ruta a la que se redirige después del login exitoso para el administrador
    protected $guard = 'admin'; // Nombre del guard utilizado para el administrador en el archivo config/auth.php

    // Método para mostrar el formulario de login para el administrador
    public function showLoginForm()
    {
        return view('admin.login.index');
    }

    // Método para realizar el login para el administrador
    public function login(Request $request)
    {
        $this->validate($request, [
            'cedula' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('admin')->attempt(['cedula' => $request->cedula, 'password' => $request->password])) {
            // Autenticación exitosa para el administrador
            return redirect()->intended($this->redirectTo);
        }

        // Autenticación fallida para el administrador
        return back()->withInput($request->only('cedula'))->withErrors([
            'cedula' => 'Credenciales inválidas para el administrador.',
        ]);
    }

    // Método para realizar el logout para el administrador
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect('/admin/login');
    }
}
