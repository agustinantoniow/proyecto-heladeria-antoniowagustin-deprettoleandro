<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria; 
use App\Models\Producto;  

class ClienteController extends Controller
{
    // Carga la vista principal dinámica del cliente logueado
    public function inicio() 
    {
        // 1. Categorías
        $categorias = Categoria::with(['productos' => function($query) {
            $query->where('activo', true);
        }])->get();

        // 2. Recomendados
        $recomendados = Producto::where('activo', true)
            ->withCount('detalles') 
            ->orderBy('detalles_count', 'desc')
            ->take(3)
            ->get();

        // 3. Novedades
        $novedades = Producto::where('activo', true)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // 4. Ofertas
        $productosOferta = Producto::where('activo', true)
            ->whereHas('categoria', function($query) {
                $query->where('nombre', 'like', '%Familiar%')
                      ->orWhere('nombre', 'like', '%Agua%');
            })
            ->take(3)
            ->get();

        return view('frontend.heladeriaGlaceCliente', compact('categorias', 'recomendados', 'novedades', 'productosOferta')); 
    }
}