<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\VentaCabecera;
use App\Models\VentaDetalle;

class PerfilController extends Controller
{
    // Muestra el formulario con los datos actuales del cliente
    public function ver()
    {
        $usuario = auth()->user();
        return view('frontend.perfil', compact('usuario'));
    }

    
    // Procesa la actualización de los datos
    public function actualizar(Request $request)
    {
        $usuario = auth()->user();

        // 1. Validaciones robustas con el nuevo campo 'usuario'
        $request->validate([
            'nombre'   => ['required', 'string', 'min:5', 'max:255', 'regex:/^[\pL\s]+$/u'],
            
            // Validamos que el usuario no tenga espacios, tenga min 5 caracteres y sea único (ignorando el propio)
            'usuario'  => ['required', 'string', 'min:5', 'max:50', 'regex:/^\S+$/', Rule::unique('usuarios', 'usuario')->ignore($usuario->id)],
            
            'email'    => ['required', 'string', 'email:rfc,dns', 'max:255', Rule::unique('usuarios')->ignore($usuario->id)],
            'password' => ['nullable', 'string', 'min:6', 'max:200', 'confirmed'], 
        ],[
            // Mensajes de error en Español
            'nombre.required'    => 'El nombre completo es obligatorio.',
            'nombre.min'         => 'El nombre debe tener al menos 5 caracteres.',
            'nombre.max'         => 'El nombre no puede superar los 255 caracteres.',
            'nombre.regex'       => 'El nombre solo puede contener letras y espacios.',
            
            'usuario.required'   => 'El nombre de usuario es obligatorio.',
            'usuario.min'        => 'El nombre de usuario debe tener al menos 5 caracteres.',
            'usuario.max'        => 'El nombre de usuario no puede superar los 50 caracteres.',
            'usuario.regex'      => 'El nombre de usuario no puede contener espacios en blanco.',
            'usuario.unique'     => 'Este nombre de usuario ya está siendo usado por otra persona. ¡Elegí otro!',

            'email.required'     => 'El correo electrónico es obligatorio.',
            'email.email'        => 'Por favor, ingresá un correo válido.',
            'email.email:rfc,dns'=> 'El formato del correo electrónico no es válido.',
            'email.unique'       => 'Este correo ya está siendo usado por otra cuenta.',
            
            'password.min'       => 'La nueva contraseña debe tener al menos 6 caracteres.',
            'password.max'       => 'La nueva contraseña es demasiado larga.',
            'password.confirmed' => 'Las contraseñas no coinciden. Verificalas usando el botón del ojito.',
        ]);

        // 2. Actualizamos los datos básicos
        $usuario->nombre = $request->nombre;
        $usuario->usuario = $request->usuario; // <-- Agregamos el guardado del nuevo usuario
        $usuario->email = $request->email;

        // 3. Solo tocamos la contraseña si el usuario escribió algo
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        // 4. Guardamos los cambios
        $usuario->save();

        return redirect()->back()->with('success', '¡Tu perfil ha sido actualizado con éxito!');
    }
   public function misCompras()
    {
        // Traemos solo los pedidos 'completados' del usuario logueado, ordenados del más nuevo al más viejo
        $compras = \App\Models\VentaCabecera::where('user_id', auth()->id())
                                            ->where('estado', 'completado')
                                            ->orderBy('fecha_venta', 'desc')
                                            ->get();

        // Fijate que acá le puse 'frontend.compras' porque el error dice que tu archivo se llama compras.blade.php
        return view('frontend.compras', compact('compras')); 
    }
}