<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Categoria; // Seguramente esta ya la tenías
use App\Models\Producto;


class CatalogoController extends Controller
{
    // 1. ESTA ES LA FUNCIÓN NUEVA PARA LA PÁGINA PRINCIPAL
   public function index()
{
    // 1. NUESTROS PRODUCTOS: Traemos todas las categorías con sus productos activos
    $categorias = Categoria::with(['productos' => function($query) {
        $query->where('activo', true);
    }])->get();

    // 2. RECOMENDADOS: Los más vendidos (Contamos cuántas veces aparecen en los detalles de ventas)
    // Nota: Si la relación en tu modelo Producto se llama 'ventaDetalles', cambialo acá abajo
    $recomendados = Producto::where('activo', true)
        ->withCount('detalles') 
        ->orderBy('detalles_count', 'desc')
        ->take(3) // Tu carrusel muestra 3 productos
        ->get();

    // 3. NOVEDADES: Los últimos productos cargados en el sistema
    $novedades = Producto::where('activo', true)
        ->orderBy('created_at', 'desc')
        ->take(4) // Tu grilla de novedades tiene espacio para 4 tarjetas
        ->get();

    // 4. OFERTAS: Traemos productos que pertenezcan a la línea 'Familiar' o 'Agua'
    $productosOferta = Producto::where('activo', true)
        ->whereHas('categoria', function($query) {
            $query->where('nombre', 'like', '%Familiar%')
                  ->orWhere('nombre', 'like', '%Agua%');
        })
        ->take(3) // Tu sección de ofertas tiene 3 tarjetas
        ->get();

    // Enviamos todas las variables juntas a la vista
    return view('frontend.heladeriaglaceVisitante', compact('categorias', 'recomendados', 'novedades', 'productosOferta')); 
}

    // 2. ESTA ES LA FUNCIÓN QUE YA TENÍAS (No la borres)
    public function porCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);
        $productos = $categoria->productos()->where('activo', true)->get();
        return view('cliente.categoria_productos', compact('categoria', 'productos'));
    }
    // Adentro de CatalogoController.php


}