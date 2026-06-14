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