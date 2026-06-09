<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CatalogoController extends Controller
{
    // 1. ESTA ES LA FUNCIÓN NUEVA PARA LA PÁGINA PRINCIPAL
    public function index()
    {
        // Traemos todas las categorías. 
        // Usamos 'with' para traer también los productos activos de cada categoría (y que tu ->take(4) funcione bien)
        $categorias = Categoria::with(['productos' => function($query) {
            $query->where('activo', true);
            
        }])->get();

        // Cambia 'welcome' por el nombre de tu vista principal si se llama distinto
        return view('welcome', compact('categorias')); 
    }

    // 2. ESTA ES LA FUNCIÓN QUE YA TENÍAS (No la borres)
    public function porCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);
        $productos = $categoria->productos()->where('activo', true)->get();
        return view('cliente.categoria_productos', compact('categoria', 'productos'));
    }
}