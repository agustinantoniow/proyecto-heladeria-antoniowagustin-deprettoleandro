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
        // 1. Validamos los datos (muy importante para la seguridad)
        $request->validate([
            'nombreConsulta'  => 'required|string|max:255',
            'emailConsulta'   => 'required|email',
            'Numero_Telefono'  => 'required',
            'mensaje' => 'required|min:5',
        ]);

        // 2. Por ahora, como estamos probando, vamos a devolver un mensaje.
        // En el futuro, acá guardaríamos en la DB o enviaríamos un Mail.
        return back()->with('success', '¡Gracias ' . $request->nombre . '! Tu consulta sobre "' . $request->asunto . '" fue enviada correctamente.');
    }
}