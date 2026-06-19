<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria; 
use App\Models\Producto;  

class ClienteController extends Controller
{
    
    public function inicio() 
    {
        
        $categorias = Categoria::with(['productos' => function($query) {
            $query->where('activo', true);
        }])->get();

        $recomendados = Producto::where('activo', true)
            ->withCount('detalles') 
            ->orderBy('detalles_count', 'desc')
            ->take(3)
            ->get();

        $novedades = Producto::where('activo', true)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

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