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
            'nombre'=> ['required', 'string', 'min:6', 'max:255'],
            'apellido' => ['required', 'string', 'min:6', 'max:255'],
            'usuario'  => ['required', 'string', 'min:6', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:255'],
            'email' => ['required', 'email', 'min:6', 'max:255','unique:users,email',],

        ]);

        // 2. Hacemos el "puente": tomamos 'usuario' del request y lo buscamos en la columna 'nombre'
        $credenciales = [
            'usuario'   => $request->usuario,
            'password' => $request->password
        ];
     $messages = [
        // Mensajes para el campo 'nombre'
        'nombre.required' => 'El nombre es obligatorio para poder registrarte.',
        'nombre.max'      => 'El nombre no puede tener más de 255 caracteres.',

        // Mensajes para el campo 'apellido'
        'apellido.required' => 'Por favor, ingresá tu apellido.',

        // Mensajes para el campo 'email'
        'email.required' => 'Necesitamos tu correo electrónico para identificar tu cuenta.',
        'email.email'    => 'El formato del correo no es válido. Ej: usuario@heladeria.com.',

        // Mensajes para el campo 'password'
        'password.required' => 'La contraseña es obligatoria por cuestiones de seguridad.',
        'password.max' => 'La contraseña no puede tener más de 255 caracteres.',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres para ser segura.',
        
        
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
