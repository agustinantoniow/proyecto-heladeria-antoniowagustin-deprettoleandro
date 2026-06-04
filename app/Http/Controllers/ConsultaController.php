<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Agregamos este import para no poner \DB siempre

class ConsultaController extends Controller
{
    // Muestra la lista de consultas al admin
    public function index()
    {
        $consultas = DB::table('consultas')->orderBy('created_at', 'desc')->get();
        return view('admin.consultas', compact('consultas'));
    }


    // Procesa el envío del formulario
    public function store(Request $request)
    {
        $request->validate([
            'nombreConsulta'  => 'required|string|max:255|min:7',
            'emailConsulta'   => 'required|email',
            'numero_telefono' => 'required|digits:10',
            'opcion_consulta' => 'required', // Validamos el nuevo campo
            'mensaje'         => 'required|min:5',
        ]);

        DB::table('consultas')->insert([
            'nombre'          => $request->nombreConsulta,
            'email'           => $request->emailConsulta,
            'numero_telefono' => $request->numero_telefono,
            'tipo'            => $request->opcion_consulta, // Guardamos la categoría seleccionada
            'mensaje'         => $request->mensaje,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return redirect('/exito');
    }
    public function marcarLeido($id)
{
    $consulta = \App\Models\Consulta::findOrFail($id);
    $consulta->leido = true;
    $consulta->save();

    return back()->with('success', 'Consulta marcada como leída.');
}
}