<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Usuario; // Importamos el modelo para hablar con la base de datos
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Importamos la herramienta para encriptar contraseñas
use Illuminate\Support\Facades\Route; //  ESTO ES LO CORRECTO

class UsuarioController extends Controller
{
    // 1. Esta función muestra la pantalla HTML del registro
    public function create()
    {
        return view('frontend.registrarse'); 
    }

    // 2. ESTA ES LA FUNCIÓN QUE FALTABA: Recibe los datos y los guarda
   public function store(Request $request)
{
    $request->validate([
        'nombre'   => 'required',
        'apellido' => 'required',
        'email'    => 'required',
        'password' => 'required',
    ]);

    // Usamos el método estático create que es mucho más seguro para verificar errores
    Usuario::create([
        'nombre'    => $request->nombre,
        'apellido'  => $request->apellido,
        'email'     => $request->email,
        'usuario'   => $request->usuario ?? explode('@', $request->email)[0],
        'password'  => Hash::make($request->password),
        'perfil_id' => 2, // Tu clave foránea en la tabla usuarios es perfil_id
        'estado'    => true
    ]);
    Auth::login(Usuario::where('email', $request->email)->first()); // Inicia sesión automáticamente después de registrarse

 return redirect('/Cliente');
}
    // ==========================================
    // FUNCIONES DEL LOGIN
    // ==========================================

    // 1. Muestra la pantalla del Login (la del carrusel)
    public function showLoginForm()
    {
        // Cambiá 'auth.login' por el nombre y carpeta donde guardaste tu vista de login
        return view('login'); 
    }

    // 2. Recibe los datos y verifica si el usuario existe y la contraseña es correcta
   public function login(Request $request)
{
    // 1. Validamos que el usuario haya escrito ambos campos
    $request->validate([
        'usuario'  => 'required|string',
        'password' => 'required|string',
    ], [
        'usuario.required'  => 'Por favor, ingresá tu nombre de usuario.',
        'password.required' => 'Por favor, ingresá tu contraseña.',
    ]);

    // 2. Buscamos al usuario en la tabla usando tu modelo Usuario
    $user = Usuario::where('usuario', $request->usuario)->first();

    // 3. Verificamos si el usuario existe y si la contraseña coincide con el Hash encriptado
    if ($user && Hash::check($request->password, $user->password)) {
        
        // 4. Lo logueamos manualmente en el sistema de Laravel
        Auth::login($user);

        // 5. Regeneramos la sesión de forma segura (Esto previene el error 419)
        $request->session()->regenerate();

        // 👑 6. Evaluamos el perfil_id para saber a dónde mandarlo
        if ($user->perfil_id == 1) {
            // Si es Administrador, va a su panel
            return redirect('/admin/dashboard')->with('success', 'Modo Administrador iniciado.');
        }

        // 🍦 Si es Cliente (perfil_id == 2 u otro), va a la vista de clientes
        return redirect('/Cliente')->with('success', '¡Bienvenido a Glace!');
    }

    // 7. Si los datos no coinciden, volvemos atrás con el mensaje de error
    return back()->withErrors([
        'usuario' => 'El usuario o la contraseña no coinciden con nuestros registros.',
    ])->withInput($request->only('usuario')); 
}
// ==========================================
// FUNCIÓN PARA CERRAR SESIÓN
// ==========================================
public function logout(Request $request)
{
    // 1. Desautentica al usuario (borra el estado de logueado)
    Auth::logout();

    // 2. Invalida la sesión actual del navegador
    $request->session()->invalidate();

    // 3. Regenera el token CSRF por seguridad
    $request->session()->regenerateToken();

    // 4. Redirecciona limpio a la página principal (ahora lo verá como visitante)
    return redirect('/')->with('success', '¡Cerraste sesión correctamente!');
}
}
