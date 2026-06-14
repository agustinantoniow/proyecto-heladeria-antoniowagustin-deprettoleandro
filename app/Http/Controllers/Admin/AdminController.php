<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consulta; 
use App\Models\VentaCabecera;
use App\Models\VentaDetalle;
use Illuminate\Support\Facades\DB;
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
    // Asegúrate de que esta línea esté arriba de todo en el archivo

public function listarVentasAdmin()
{
    // Traemos de la base de datos TODOS los detalles de ventas que estén 'completado'
    $ventas = DB::table('venta_detalles')
        ->join('venta_cabeceras', 'venta_detalles.venta_cabecera_id', '=', 'venta_cabeceras.id')
        ->join('productos', 'venta_detalles.producto_id', '=', 'productos.id')
        ->leftJoin('categorias', 'productos.categoria_id', '=', 'categorias.id')
        ->where('venta_cabeceras.estado', '=', 'completado') // Filtramos solo las pagadas/completadas
        ->select(
            'venta_detalles.id as detalle_id',           // ID único del renglón de la tabla
            'venta_cabeceras.id as cabecera_id',         // ID de la orden general
            'venta_cabeceras.updated_at as fecha_pago',  // Cuándo se completó la venta
            'venta_detalles.cantidad as cantidad',
            'venta_detalles.precio_unitario as precio_unitario',
            'venta_detalles.subtotal as subtotal',
            'productos.nombre as producto_nombre',
            'productos.imagen as producto_imagen',
            'categorias.nombre as categoria_nombre'
        )
        ->orderBy('venta_detalles.id', 'desc') // Lo último vendido aparece arriba de todo
        ->get();

    // Contamos el total de filas para el contador rojo de la esquina
    $totalVentas = $ventas->count();

    // Retornamos tu vista pasándole ambas variables
    return view('admin.ventas.index', compact('ventas', 'totalVentas'));
}
}