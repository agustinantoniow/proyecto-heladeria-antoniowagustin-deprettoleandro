<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // 1. Muestra la tabla principal con todos los productos
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        $categorias = Categoria::all();
        
        return view('backend.admin.productos.index', compact('productos', 'categorias'));
    }

    // 2. Muestra la vista con el formulario para agregar un producto
    public function create()
    {
        $categorias = Categoria::all();
        return view('backend.admin.productos.create', compact('categorias'));
    }

    // 3. Recibe los datos del formulario y los guarda en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'categoria_id' => 'required|integer',
            'precio'       => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'descripcion'  => 'nullable|string'
        ]);
        
        $nombreImagen = null;
    if ($request->hasFile('imagen')) {
        $imagen = $request->file('imagen');
        $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
        $imagen->move(public_path('uploads/productos'), $nombreImagen);
    }

        Producto::create([
            'nombre'       => $request->nombre,
            'categoria_id' => $request->categoria_id,
            'descripcion'  => $request->descripcion,
            'precio'       => $request->precio,
            'stock'        => $request->stock,
            'imagen'       => $nombreImagen,
            'activo'       => true
        ]);

        return redirect()->route('admin.productos.index')->with('success', '¡Producto agregado con éxito!');
    }
    public function catalogoPublico()
{
    // Traemos solo los helados que estén activos (1) con su categoría
   $productos = Producto::where('activo', 1)->with('categoria')->get();

    // Retornamos la vista pública (asegurate de crearla en esta carpeta)
    return view('frontend.productos.catalogo', compact('productos'));
}

    // 4. Alterna el estado de activo/inactivo de un producto
    public function toggleStatus(Producto $producto)
    {
        $producto->update(['activo' => !$producto->activo]);

        return redirect()->route('admin.productos.index')->with('success', 'Estado del producto actualizado con éxito!');
    }
    public function updateFast(Request $request, $id)
{
    // Validamos que los datos enviados cumplan los requisitos básicos
    $request->validate([
        'nombre' => 'sometimes|required|string|max:255',
        'precio' => 'sometimes|required|numeric|min:0',
        'stock'  => 'sometimes|required|integer|min:0',
    ]);

    try {
        $producto = Producto::findOrFail($id);
        
        // Actualizamos dinámicamente solo los campos que vengan en la petición
        $producto->update($request->only(['nombre', 'precio', 'stock']));

        return response()->json([
            'success' => true,
            'message' => 'Producto actualizado correctamente.'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al actualizar el producto: ' . $e->getMessage()
        ], 500);
    }
}
public function destroy($id)
{
    $producto = \App\Models\Producto::findOrFail($id);
    
    // Si el helado tiene una foto guardada en el servidor, la borramos para no acumular archivos basura
    if ($producto->imagen && file_exists(public_path('uploads/productos/' . $producto->imagen))) {
        unlink(public_path('uploads/productos/' . $producto->imagen));
    }

    // Borramos el registro de la base de datos
    $producto->delete();

    // Redireccionamos de vuelta con el mensaje de éxito
    return redirect()->route('admin.productos.index')->with('success', 'El producto ha sido eliminado permanentemente del catálogo.');
}
}