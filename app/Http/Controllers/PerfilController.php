<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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

        // Validamos los datos que ingresó el cliente
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email'  => ['required', 'string', 'email', 'max:255', Rule::unique('usuarios')->ignore($usuario->id)],
            'password' => 'nullable|string|min:6|confirmed', // 'confirmed' pide un campo password_confirmation
        ]);

        // Actualizamos los datos básicos
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;

        // Si el usuario escribió una contraseña nueva, la encriptamos y la cambiamos
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->back()->with('success', '¡Tu perfil ha sido actualizado con éxito!');
    }
}