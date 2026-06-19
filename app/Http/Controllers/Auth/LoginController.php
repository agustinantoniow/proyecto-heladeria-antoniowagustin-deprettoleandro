<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Procesa el intento de autenticación.
     */
    public function login(Request $request)
    {
        // 1. Mensajes de error personalizados en Español para el Login
        $messages = [
            'usuario.required'  => 'El nombre de usuario es obligatorio.',
            'usuario.regex'     => 'El nombre de usuario no puede contener espacios en blanco.',
            'password.required' => 'La contraseña es obligatoria.',
        ];

        // 2. Validamos SOLO los campos que vienen del formulario de Login
        $request->validate([
            // regex:/^\S+$/ bloquea los espacios en blanco
            'usuario'  => ['required', 'string', 'regex:/^\S+$/'],
            'password' => ['required', 'string'],
        ], $messages);

        // 3. Armamos las credenciales para buscar en la base de datos
        $credenciales = [
            'usuario'  => $request->usuario,
            'password' => $request->password
        ];

        // 4. Intentamos la autenticación segura con Laravel
        if (Auth::attempt($credenciales)) {

            // Regeneramos la sesión por seguridad contra ataques de fijación
            $request->session()->regenerate();
            
            // Redirección inteligente según el rol (perfil_id)
            if (Auth::user() && Auth::user()->perfil_id == 1) {
                // Si es Administrador, va al panel de control
                return redirect('/admin/dashboard');
            }
            
            // Si es Cliente (perfil_id 2 o cualquier otro), va a la tienda
            return redirect('/productos');
        }

        // 5. Si la contraseña o el usuario son incorrectos, lo rebotamos con error
        return back()->withErrors([
            'usuario' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('usuario'); 
    }

    /**
     * Destruye la sesión del usuario (Cierre de sesión).
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}