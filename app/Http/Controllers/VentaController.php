<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VentaDetalle; 
use App\Models\Producto;

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
    // 1. Obtenemos el ID del usuario que está navegando
    $usuarioId = auth()->id();

    // 2. Traemos los detalles de venta filtrando por su cabecera
    $compras =VentaDetalle::with(['producto.categoria', 'cabecera'])
        ->whereHas('cabecera', function($query) use ($usuarioId) {
            $query->where('user_id', $usuarioId) // 🌟 Solo las compras de este usuario
                  ->where('estado', 'completada'); // 🌟 Solo las que ya pagó/concretó
        })
        ->latest() // Las ordena de la más reciente a la más vieja
        ->get();

    // 3. Retornamos la vista dentro de las carpetas del cliente
    return view('frontend.compras', compact('compras'));
}
}