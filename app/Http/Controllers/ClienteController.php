<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\http\Controllers\Producto;

class ClienteController extends Controller
{
    /**
     * Muestra la pantalla principal para el cliente autenticado.
     */
    public function index()
    {
        $categorias = Categoria::all();
        // Cambia 'frontend.cliente' por la ruta real de tu vista 
        // (por ejemplo: 'cliente.index', 'home', etc.)
        return view('frontend.heladeriaglaceCliente', compact('categorias')); 
    }
    public function verCategoria($id)
{
    // Buscamos la categoría o tiramos error 404 si alguien inventa un ID en la URL
    $categoria = Categoria::findOrFail($id);

    // Traemos solo los productos que pertenecen a esta categoría
    // Nota: Si quieres que en el catálogo del cliente NO aparezcan los eliminados, usa softDeletes o las condiciones que ya tengas
  

    return view('cliente.categoria', compact('categoria', 'productos'));
}
}