<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consulta; 

class AdminController extends Controller
{
    /**
     * 1. Muestra la pantalla principal (Tarjetas de resumen)
     * Responde a la ruta /admin/dashboard
     */
    public function dashboard()
    {
        return view('backend.admin.dashboard');
    }

    /**
     * 2. Muestra el listado completo de la tabla de consultas
     * Responde a la ruta /admin/consultas
     */
    public function index()
    {
        // Traemos todas las consultas ordenadas por fecha
        $consultas = Consulta::orderBy('created_at', 'desc')->get();

        // Retornamos la vista ESPECÍFICA de la tabla
        return view('backend.admin.consultas', compact('consultas'));
    }

    /**
     * 3. Método para marcar como leída
     */
    public function marcarLeido($id)
    {
        $consulta = Consulta::findOrFail($id);
        $consulta->leido = true;
        $consulta->save();

        return back()->with('success', 'Consulta marcada como leída.');
    }

    /**
     * Método para eliminar una consulta definitivamente de la base de datos
     */
    public function destroy($id)
    {
        // 1. Buscamos la consulta por su ID (findOrFail tira error 404 si no existe)
        $consulta = Consulta::findOrFail($id);
        
        // 2. La eliminamos
        $consulta->delete();

        // 3. Volvemos a la misma página donde estábamos
        return back()->with('success', 'Consulta eliminada del sistema.');
    }
}