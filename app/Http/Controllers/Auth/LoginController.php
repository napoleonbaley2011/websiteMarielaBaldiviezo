<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // Muestra el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');
    }
    // Procesa el inicio de sesión
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Verifica si las credenciales son válidas
        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard')->with(['success' => 'Has iniciado sesión correctamente.']);
        }

        // Si las credenciales son incorrectas, lanza un error
        throw ValidationException::withMessages([
            'email' => 'El correo electrónico o la contraseña son incorrectos.'
        ]);
    }

    // Procesa el cierre de sesión
    public function destroy()
    {
        Auth::logout();

        // Regenerar sesión por seguridad
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login')->with(['success' => 'Has cerrado sesión correctamente.']);
    }
}
