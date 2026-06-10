<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
   public function mostrarCategoria($slug)
{
    // 1. Buscamos la categoría por su slug
    $categoria = Categoria::where('slug', $slug)->firstOrFail();

    // 2. Traemos los productos activos de esa categoría
    $productos = Producto::where('categoria_id', $categoria->id)
                         ->where('activo', 1)
                         ->get();

    // 3. ¡CLAVE! Asegurate de pasar 'categoria' dentro del compact
    return view('frontend.heladeriaGlaceCliente', compact('categoria', 'productos'));
}
}