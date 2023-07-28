<?php

namespace App\Http\Controllers\Emp;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importamos la clase Auth
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class DefaultLoginController extends Controller
{
    protected $redirectTo = '/enterprise/dashboard'; // Ruta a la que se redirige después del login exitoso para el usuario default

    // Método para mostrar el formulario de login para el usuario default
    public function showLoginForm()
    {
        return view('user.login.index');
    }

    // Método para realizar el login para el usuario default
    public function login(Request $request)
    {
        $this->validate($request, [
            'cedula_ruc' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('web')->attempt(['cedula_ruc' => $request->cedula_ruc, 'password' => $request->password])) {
            // Autenticación exitosa para el usuario default
    
            // Guardar todos los datos del usuario en la sesión web
            $user = Auth::guard('web')->user();
            $request->session()->put('user_data', $user);
    
            return redirect()->intended($this->redirectTo);
        }
    
        // Autenticación fallida para el usuario default
        return back()->withInput($request->only('cedula_ruc'))->withErrors([
            'cedula_ruc' => 'Credenciales inválidas para el usuario default.',
        ]);
    }

    // Método para realizar el logout para el usuario default
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        return redirect('/enterprise/login');
    }
}
