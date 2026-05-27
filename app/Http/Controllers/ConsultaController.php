<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * Maneja el envío del formulario de consultas.
     */
   public function store(Request $request)
{
    // 1. Validamos usando los nombres exactos que vendrán del formulario
    $request->validate([
        'nombreConsulta'  => 'required|string|max:255|min:7',
        'emailConsulta'   => 'required|email',
        'numero_telefono' => 'required|digits:10',
        'mensaje'         => 'required|min:5',
    ]);

    // 2. IMPORTANTE: Guardamos los datos reales en la tabla 'consultas' usando Query Builder
    // Usamos DB porque coincide directo con tu estructura de dBeaver
    \DB::table('consultas')->insert([
        'Nombre'          => $request->nombreConsulta, // <-- PASAMOS EL NOMBRE A SU COLUMNA PROPIA
        'email'           => $request->emailConsulta,
        'numero_telefono' => $request->numero_telefono,
        'mensaje'         => 'Nombre: ' . $request->nombreConsulta . ' - Mensaje: ' . $request->mensaje,
        'created_at'      => now(),
        'updated_at'      => now(),
    ]);

    // 3. Redirección con mensaje de éxito (corregido el error de $request->asunto que no existía)
    return redirect('/exito');
}
}