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
        'Nombre'   => 'required',
        'Apellido' => 'required',
        'email'    => 'required',
        'password' => 'required',
    ]);

    // Usamos el método estático create que es mucho más seguro para verificar errores
    Usuario::create([
        'nombre'    => $request->Nombre,
        'apellido'  => $request->Apellido,
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
        // Validamos que hayan escrito algo
       $credenciales = $request->validate([
        'usuario'  => 'required|string',
        'password' => 'required|string',
    ], [
        'usuario.required'  => 'Por favor, ingresá tu nombre de usuario.',
        'password.required' => 'Por favor, ingresá tu contraseña.',
    ]);

        // Auth::attempt busca el email en la BD y compara la contraseña encriptada
        if (Auth::attempt($credenciales)) {
            // Si todo está bien, crea la sesión de seguridad
            $request->session()->regenerate();

            // Lo mandamos a la vista principal de la heladería (o a los productos)
           return redirect('/Cliente')->with('success', '¡Bienvenido a Glace!');
        }

        // Si la contraseña o el email están mal, lo devolvemos al login con un error
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
