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

        // Validamos los datos que ingresó el cliente
        $request->validate([
            'nombre' => 'required|string|max:255|min:5|regex:/^[a-zA-Z\s]+$/', // Solo letras y espacios
            'email'  => ['required', 'string', 'email', 'max:255', Rule::unique('usuarios')->ignore($usuario->id), 'email:rfc,dns'],
            'password' => 'nullable|string|min:6|confirmed|max:200|required_with:password_confirmation', // 'confirmed' pide un campo password_confirmation
        ],[
            'nombre.required'    => 'El nombre es obligatorio.',
            'nombre.min'    => 'el nombre debe tener minimo 5 caracteres.',
            'nombre.regex'       => 'El nombre no puede contener números ni caracteres especiales.', // <-- Tu mensaje personalizado
            'email.required'     => 'El correo electrónico es obligatorio.',
            'email.email'        => 'Por favor, ingresa un correo válido.',
            'email.unique'       => 'Este correo ya está registrado por otro usuario.',
            'email.email:rfc,dns' => 'El formato del correo electrónico no es válido.',
            'password.required' => 'La nueva contraseña es obligatoria.',
            'password.min'       => 'La nueva contraseña debe tener al menos 6 caracteres.',
             'password.max'       => 'La nueva contraseña debe tener como máximo 200 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        // Actualizamos los datos básicos
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->password = $request->password;
        // Si el usuario escribió una contraseña nueva, la encriptamos y la cambiamos
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }else {
    // REGLA DE ORO: Si está vacío, nos aseguramos de que Eloquent ignore los cambios en esta columna
    unset($usuario->password); 
    // Opcional, por si se guardó un string vacío previo en el modelo:
    // $usuario->syncOriginalAttribute('password'); 
}

        $usuario->save();

        return redirect()->back()->with('success', '¡Tu perfil ha sido actualizado con éxito!');
    }
   public function misCompras()
{
    // 1. Ver qué ID de usuario está detectando Laravel al estar logueado
    $usuarioLogueado = auth()->id();

    // 2. Traer las cabeceras de este usuario sin importar el estado
    $cabecerasUsuario = \Illuminate\Support\Facades\DB::table('venta_cabeceras')
        ->where('user_id', $usuarioLogueado)
        ->get();

    // 3. Traer TODAS las cabeceras completadas que existan en el sistema
    $cabecerasCompletadas = \Illuminate\Support\Facades\DB::table('venta_cabeceras')
        ->where('estado', 'completado')
        ->get();

    // 4. Ver si hay algo en la tabla de detalles
    $todosLosDetalles = \Illuminate\Support\Facades\DB::table('venta_detalles')->get();

    // Congelamos la pantalla para revisar los datos reales
    dd([
        'ID Usuario Logueado' => $usuarioLogueado,
        'Cabeceras de este usuario en la BD' => $cabecerasUsuario->toArray(),
        'Total cabeceras del sistema en estado completado' => $cabecerasCompletadas->toArray(),
        'Total filas en venta_detalles' => $todosLosDetalles->toArray(),
    ]);
}
}