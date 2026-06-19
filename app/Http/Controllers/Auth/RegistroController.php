<?php

namespace App\Http\Controllers\Auth; // Carpeta Auth

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario; // Modelo de usuarios
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    // Muestra la vista del formulario
    public function mostrarFormulario()
    {
        return view('frontend.registro'); 
    }

    // Procesa el formulario con todas las validaciones solicitadas
    public function registrar(Request $request)
    { 
        // 1º Validaciones estrictas con mensajes personalizados
        // El regex:/^\S+$/ garantiza que NO se permitan espacios en blanco en ninguna parte de la cadena
        $request->validate([
            'nombre'   => ['required', 'string', 'max:50', 'regex:/^\S+$/'],
            'apellido' => ['required', 'string', 'max:50', 'regex:/^\S+$/'],
            
            // Valida formato de email y que no se repita en la tabla 'usuarios'
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:usuarios,email'],
            
            // Mínimo 5 caracteres, sin espacios y único en la tabla 'usuarios'
            'usuario'  => ['required', 'string', 'min:5', 'max:50', 'regex:/^\S+$/', 'unique:usuarios,usuario'],
            
            // 'confirmed' exige que llegue un campo llamado 'password_confirmation' idéntico
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            // Mensajes de error personalizados en Español
            'nombre.required'   => 'El nombre es obligatorio.',
            'nombre.max'        => 'El nombre no puede tener más de 50 caracteres.',
            'nombre.regex'      => 'El nombre no puede contener espacios en blanco.',
            
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.max'      => 'El apellido no puede tener más de 50 caracteres.',
            'apellido.regex'    => 'El apellido no puede contener espacios en blanco.',
            
            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.email'       => 'Por favor, ingresá un formato de correo electrónico válido.',
            'email.unique'      => 'Este correo electrónico ya se encuentra registrado.',
            
            'usuario.required'  => 'El nombre de usuario es obligatorio.',
            'usuario.min'       => 'El nombre de usuario debe tener al menos 5 caracteres.',
            'usuario.max'       => 'El nombre de usuario no puede tener más de 50 caracteres.',
            'usuario.regex'     => 'El nombre de usuario no puede contener espacios en blanco.',
            'usuario.unique'    => 'Este nombre de usuario ya existe en la base de datos, por favor elegí otro.',
            
            'password.required' => 'La contraseña es obligatoria.',
            'password.min'      => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed'=> 'Las contraseñas no coinciden. Verificalas usando el botón del ojito.',
        ]);

        // 2º Si pasa las validaciones, crea el registro de forma segura
        Usuario::create([
            'nombre'    => $request->nombre,
            'apellido'  => $request->apellido,
            'email'     => $request->email,
            'usuario'   => $request->usuario,              
            'password'  => Hash::make($request->password), 
            'perfil_id' => 2,                                 
            'estado'    => 1,                                 
        ]);
        
        // Volvemos atrás para encender el cartel de éxito de tu HTML con el botón de ingreso
        return redirect()->back()->with('success', '¡Usuario creado con éxito!');
    }
}