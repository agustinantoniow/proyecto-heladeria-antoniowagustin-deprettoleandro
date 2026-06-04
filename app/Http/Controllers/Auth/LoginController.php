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
        // 1. Validamos los campos tal cual vienen de tu formulario Blade (name="usuario")
        $request->validate([
            'usuario'  => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // 2. Hacemos el "puente": tomamos 'usuario' del request y lo buscamos en la columna 'nombre'
        $credenciales = [
            'usuario'   => $request->usuario,
            'password' => $request->password
        ];

        // 3. Intentamos la autenticación segura con Laravel
        if (Auth::attempt($credenciales)) {

            // Regeneramos la sesión por seguridad contra ataques de fijación
            $request->session()->regenerate();
            // 4. Redirección inteligente según el rol (perfil_id)
            if (Auth::user() && Auth::user()->perfil_id == 1) {
                // Si es Administrador, va al panel de control
                return redirect('/admin/dashboard');;
            }
            
            // Si es Cliente (perfil_id 2 o cualquier otro), va a la tienda
            return redirect('/productos');
        }

        // 5. Si la verificación falla, mandamos el error etiquetado como 'usuario'
        // Esto activa automáticamente tu @error('usuario') en el Blade
        return back()->withErrors([
            'usuario' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('usuario'); // Mantiene lo que el usuario escribió para que no tenga que rellenar todo de nuevo
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
