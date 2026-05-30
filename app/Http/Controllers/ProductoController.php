<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Muestra la lista de productos de la heladería.
     */
    public function index()
    {
    // 1. Traemos los helados reales de Docker
    $productos = Producto::all();
    
    // 2. Simulamos el rol a mano: poné 'admin' o poné 'user' para probar
    $rol_usuario = 'cliente'; 

    // 3. Mandamos las dos cosas a tu plantilla anterior
    return view('frontend.Productos', compact('productos', 'rol_usuario'));
    }

    /**
     * Mostrar el formulario de carga de un nuevo helado.
     */
    public function create()
    {
      return view('frontend.create'); 
    }

    /**
     * Guardar el nuevo helado en la BD 
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'categoria' => 'required|string|max:50',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Producto::create($request->only(['nombre', 'categoria', 'descripcion', 'precio', 'stock']));

        return redirect()->route('productos.index')->with('exito', 'Producto creado.');
    }

    /**
     * Ver el detalle de un solo producto 
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     *Mostrar el formulario para editar un producto existente
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Impactar los cambios editados en la BD 
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Borrar el helado del sistema 
     */
    public function destroy(Producto $producto)
    {
        //
    }
}

