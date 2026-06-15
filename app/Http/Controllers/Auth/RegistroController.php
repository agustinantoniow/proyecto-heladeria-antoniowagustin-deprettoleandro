<?php

namespace App\Http\Controllers\Auth; // Fijate que lleva \Auth por estar en esa carpeta

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario; // O el modelo que uses para tus usuarios
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    // Muestra la vista del formulario
    public function mostrarFormulario()
    {
        return view('frontend.registro'); // Poné la ruta real de tu vista
    }

    // Procesa el formulario (Acá va la validación que armamos antes)
   public function registrar(Request $request)
{ 
    // 1º Validamos los datos básicos SIN restricción de duplicados
    $request->validate([
        'nombre'   => 'required|string|min:5|max:50|regex:/^[\pL\s\-]+$/u',
        'apellido' => 'required|string|min:5|max:50|regex:/^[\pL\s\-]+$/u',
        
        // LE SACAMOS EL 'unique:usuarios,email'
        'email'    => ['required', 'string', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
        
        // LE SACAMOS EL 'unique' en caso de que lo tuvieras en usuario
        'usuario'  => 'required|string|alpha_num|min:4|max:50',
        'password' => 'required|string|min:6',
    ], [
        'nombre.required'   => 'El nombre es obligatorio.',
        'nombre.min'        => 'El nombre debe tener al menos 5 caracteres.',
        'nombre.regex'      => 'El nombre no puede contener números.',
        'nombre.max'        => 'El nombre no puede tener más de 50 caracteres.',
        'apellido.required' => 'El apellido es obligatorio.',
        'apellido.regex'    => 'El apellido no puede contener números.',
        'apellido.min'      => 'El apellido debe tener al menos 5 caracteres.',
        'apellido.max'      => 'El apellido no puede tener más de 50 caracteres.',
        
        'email.required'    => 'El correo electrónico es obligatorio.',
        'email.regex'       => 'Por favor, ingresá un correo completo.',

        'usuario.required'  => 'El nombre de usuario es obligatorio.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.min'      => 'La contraseña debe tener al menos 6 caracteres.',
        'password.max'      => 'La contraseña no puede tener más de 200 caracteres.',
    ]);

    // 2º Intenta guardar en la base de datos
    Usuario::create([
        'nombre'     => $request->nombre,
        'apellido'   => $request->apellido,
        'email'      => $request->email,
        'usuario'    => $request->usuario,              
        'password' => Hash::make($request->password), 
        'perfil_id'  => 2,                              
        'estado'     => 1,                              
    ]);
    
    return redirect()->route('login')->with('success', '¡Registro completado con éxito! Ya podés iniciar sesión.');
}
}