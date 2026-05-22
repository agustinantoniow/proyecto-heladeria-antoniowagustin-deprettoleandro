<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Usuario; // Importamos el modelo para hablar con la base de datos
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Importamos la herramienta para encriptar contraseñas

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
        // Validamos que el formulario venga completo
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email'    => 'required|email|unique:usuarios,email',
            'usuario'   => 'nullable|string|max:50|unique:usuarios,usuario', // Validamos el campo 'usuario' como opcional y único
            'password' => 'required|min:6',
        ]);

        // Creamos el nuevo usuario
        $usuario = new Usuario();
        $usuario->nombre   = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->email    = $request->email;
        $usuario->usuario  = $request->usuario; // Guardamos el campo 'usuario' si fue proporcionado
        $usuario->password = Hash::make($request->password); // La contraseña se guarda encriptada
        
        $usuario->perfil_id = 2; // Le asignamos el ID 2 por defecto (Cliente)
        $usuario->estado    = true;
        
        $usuario->save(); // Se guarda en MariaDB

        // Redirigimos al login con un mensaje de éxito
       return back()->with('success', '¡Registro exitoso! Ya podés iniciar sesión.');
    }
    // ==========================================
    // FUNCIONES DEL LOGIN
    // ==========================================

    // 1. Muestra la pantalla del Login (la del carrusel)
    public function showLoginForm()
    {
        // Cambiá 'auth.login' por el nombre y carpeta donde guardaste tu vista de login
        return view('loginn'); 
    }

    // 2. Recibe los datos y verifica si el usuario existe y la contraseña es correcta
    public function login(Request $request)
    {
        // Validamos que hayan escrito algo
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Auth::attempt busca el email en la BD y compara la contraseña encriptada
        if (Auth::attempt($credenciales)) {
            // Si todo está bien, crea la sesión de seguridad
            $request->session()->regenerate();

            // Lo mandamos a la vista principal de la heladería (o a los productos)
            return redirect()->intended('/productos')->with('success', '¡Bienvenido a Glace!'); 
        }

        // Si la contraseña o el email están mal, lo devolvemos al login con un error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email'); // Mantiene el email escrito para que no tenga que tipearlo de nuevo
    }
}
