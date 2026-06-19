<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Usuario; // Importamos el modelo para hablar con la base de datos
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Herramienta para encriptar contraseñas
use Illuminate\Support\Facades\Route; 

class UsuarioController extends Controller
{
    // ==========================================
    // FUNCIONES DEL REGISTRO
    // ==========================================

    // 1. Esta función muestra la pantalla HTML del registro
    public function create()
    {
        return view('frontend.registrarse'); 
    }

    // 2. Recibe los datos, los valida estrictamente y los guarda
    public function store(Request $request)
    {
        // 1º Validaciones estrictas con expresiones regulares para evitar espacios
        $request->validate([
            'nombre'   => ['required', 'string', 'max:50', 'regex:/^\S+$/'],
            'apellido' => ['required', 'string', 'max:50', 'regex:/^\S+$/'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:usuarios,email'],
            'usuario'  => ['required', 'string', 'min:5', 'max:50', 'regex:/^\S+$/', 'unique:usuarios,usuario'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            // Mensajes de error en Español
            'nombre.required'   => 'El nombre es obligatorio.',
            'nombre.max'        => 'El nombre no puede tener más de 50 caracteres.',
            'nombre.regex'      => 'El nombre no puede contener espacios en blanco.',
            
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.max'      => 'El apellido no puede tener más de 50 caracteres.',
            'apellido.regex'    => 'El apellido no puede contener espacios en blanco.',
            
            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.email'       => 'Por favor, ingresá un formato de correo válido.',
            'email.unique'      => 'Este correo electrónico ya se encuentra registrado.',
            
            'usuario.required'  => 'El nombre de usuario es obligatorio.',
            'usuario.min'       => 'El nombre de usuario debe tener al menos 5 caracteres.',
            'usuario.max'       => 'El nombre de usuario no puede tener más de 50 caracteres.',
            'usuario.regex'     => 'El nombre de usuario no puede contener espacios en blanco.',
            'usuario.unique'    => 'Este nombre de usuario ya existe en la base de datos, elegí otro.',
            
            'password.required' => 'La contraseña es obligatoria.',
            'password.min'      => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed'=> 'Las contraseñas no coinciden. Verificalas usando el botón del ojito.',
        ]);

        // 2º Guardamos de forma segura
        Usuario::create([
            'nombre'    => $request->nombre,
            'apellido'  => $request->apellido,
            'email'     => $request->email,
            'usuario'   => $request->usuario,
            'password'  => Hash::make($request->password),
            'perfil_id' => 2, // 2 = Cliente
            'estado'    => true
        ]);
        
        // 3º Lo mandamos atrás con el mensaje verde para que ahora sí inicie sesión
        return redirect()->back()->with('success', '¡Cuenta creada con éxito! Ya podés iniciar sesión.');
    }

    // ==========================================
    // FUNCIONES DEL LOGIN
    // ==========================================

    // 1. Muestra la pantalla del Login
    public function showLoginForm()
    {
        return view('frontend.login'); 
    }

    // 2. Recibe los datos y verifica si el usuario existe y la contraseña es correcta
    public function login(Request $request)
    {
        // 1. Validamos que el usuario haya escrito ambos campos (y bloqueamos espacios en el usuario)
        $request->validate([
            'usuario'  => ['required', 'string', 'regex:/^\S+$/'],
            'password' => ['required', 'string'],
        ], [
            'usuario.required'  => 'Por favor, ingresá tu nombre de usuario.',
            'usuario.regex'     => 'El nombre de usuario no puede contener espacios.',
            'password.required' => 'Por favor, ingresá tu contraseña.',
        ]);

        // 2. Buscamos al usuario en la tabla usando tu modelo Usuario
        $user = Usuario::where('usuario', $request->usuario)->first();

        // 3. Verificamos si el usuario existe y si la contraseña coincide con el Hash encriptado
        if ($user && Hash::check($request->password, $user->password)) {
            
            // 4. Lo logueamos manualmente en el sistema
            Auth::login($user);

            // 5. Regeneramos la sesión de forma segura
            $request->session()->regenerate();

            // 👑 6. Evaluamos el perfil_id para saber a dónde mandarlo
            if ($user->perfil_id == 1) {
                // Si es Administrador, va a su panel
                return redirect('/admin/dashboard')->with('success', 'Modo Administrador iniciado.');
            }

            // 🍦 Si es Cliente, va a la vista de clientes
            return redirect('/Cliente')->with('success', '¡Bienvenido a Glace!');
        }

        // 7. Si los datos no coinciden, volvemos atrás con el error
        return back()->withErrors([
            'usuario' => 'El usuario o la contraseña no coinciden con nuestros registros.',
        ])->withInput($request->only('usuario')); 
    }

    // ==========================================
    // FUNCIÓN PARA CERRAR SESIÓN
    // ==========================================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', '¡Cerraste sesión correctamente!');
    }
}