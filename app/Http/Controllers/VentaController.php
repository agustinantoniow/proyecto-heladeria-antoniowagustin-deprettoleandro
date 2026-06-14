<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VentaDetalle; 
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
class VentaController extends Controller
{
    public function index()
    {
        // Filtramos para traer solo detalles de ventas concretadas
        $ventas = VentaDetalle::with(['producto', 'cabecera'])
        ->whereHas('cabecera', function($query) {
            // Asegúrate de que 'estado' sea el nombre exacto en tu tabla cabecera
            // Y de colocar el valor con el que marcas una venta completada (ej: 'completada', 'pagada', o 2)
            $query->where('estado', 'completada'); 
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return view('backend.admin.ventas', compact('ventas'));
    }
    public function misCompras()
{
    // Buscamos directamente en la base de datos cruzando las tablas
    $compras = DB::table('venta_detalles')
        ->join('venta_cabeceras', 'venta_detalles.venta_cabecera_id', '=', 'venta_cabeceras.id')
        ->join('productos', 'venta_detalles.producto_id', '=', 'productos.id')
        ->leftJoin('categorias', 'productos.categoria_id', '=', 'categorias.id')
        ->where('venta_cabeceras.user_id', '=', auth()->id()) // Filtra por el cliente logueado
        ->where('venta_cabeceras.estado', '=', 'completado')  // Filtra que la compra esté completada
        ->select(
            'venta_cabeceras.id as cabecera_id',
            'venta_cabeceras.updated_at as fecha_pago',
            'venta_detalles.cantidad as cantidad',
            'venta_detalles.precio_unitario as precio_unitario',
            'venta_detalles.subtotal as subtotal',
            'productos.nombre as producto_nombre',
            'productos.imagen as producto_imagen',
            'categorias.nombre as categoria_nombre'
        )
        ->orderBy('venta_detalles.id', 'desc')
        ->get();

    // Retorna tu vista pasándole la variable corregida
    return view('frontend.compras', compact('compras'));
}
}