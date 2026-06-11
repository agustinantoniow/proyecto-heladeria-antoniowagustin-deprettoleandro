<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

    // 4. Alterna el estado de activo/inactivo (Pausar / Activar) del producto
    public function toggleStatus(Producto $producto)
    {
        $producto->update(['activo' => !$producto->activo]);

        return redirect()->route('admin.productos.index')->with('success', 'Estado del producto actualizado con éxito!');
    }

    // 5. Edición rápida por AJAX (Limpiado y sin duplicados)
    public function updateFast(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        
        // Actualizamos los campos de texto
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;

        $imagenUrl = null;

        // Si el usuario subió una imagen nueva, la procesamos
        if ($request->hasFile('imagen')) {
            
            // Eliminamos la imagen anterior si existe físicamente
            if ($producto->imagen) {
                $rutaAnterior = public_path('uploads/productos/' . $producto->imagen);
                if (File::exists($rutaAnterior)) {
                    File::delete($rutaAnterior);
                }
            }

            // Guardamos la nueva imagen
            $file = $request->file('imagen');
            $nombreImagen = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/productos'), $nombreImagen);
            
            $producto->imagen = $nombreImagen;
            $imagenUrl = asset('uploads/productos/' . $nombreImagen);
        }

        $producto->save();

        return response()->json([
            'success' => true,
            'message' => 'Producto actualizado correctamente.',
            'imagen_url' => $imagenUrl 
        ]);
    }

    // 6. Eliminar producto definitivamente
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        
        // Borramos la foto del servidor primero
        if ($producto->imagen) {
            $rutaImagen = public_path('uploads/productos/' . $producto->imagen);
            if (File::exists($rutaImagen)) {
                File::delete($rutaImagen);
            }
        }

        // FALTABA ESTO: Borrar el registro de la base de datos
        $producto->delete();

        return redirect()->route('admin.productos.index')->with('success', 'El producto ha sido eliminado permanentemente del catálogo.');
    }

    // 7. Catálogo para los clientes
   public function catalogoCliente()
    {
        // Traemos los helados activos
        $productos = Producto::where('activo', 1)->with('categoria')->get();
        
        // ¡NUEVO!: Traemos todas las categorías para armar los botones de filtro
        $categorias = Categoria::all();

        // Le pasamos ambas variables a la vista
        return view('frontend.catalogo', compact('productos', 'categorias'));
    }
    
    // (Nota: eliminé catalogoPublico() porque hacía exactamente lo mismo que catalogoCliente)
}