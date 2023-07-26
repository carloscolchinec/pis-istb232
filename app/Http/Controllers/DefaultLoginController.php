<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importamos la clase Auth

class DefaultLoginController extends Controller
{
    protected $redirectTo = '/user/dashboard'; // Ruta a la que se redirige después del login exitoso para el usuario default

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

        if (Auth::attempt(['cedula_ruc' => $request->cedula_ruc, 'password' => $request->password])) {
            // Autenticación exitosa para el usuario default
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
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
