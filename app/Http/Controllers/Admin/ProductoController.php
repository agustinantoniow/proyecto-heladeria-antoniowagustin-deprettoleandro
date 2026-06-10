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

    public function catalogoPublico()
    {
        // Traemos solo los helados que estén activos (1) con su categoría
        $productos = Producto::where('activo', 1)->with('categoria')->get();

        // Retornamos la vista pública
        return view('frontend.productos.catalogo', compact('productos'));
    }

    // 4. Alterna el estado de activo/inactivo (Pausar / Activar) del producto
    public function toggleStatus(Producto $producto)
    {
        $producto->update(['activo' => !$producto->activo]);

        return redirect()->route('admin.productos.index')->with('success', 'Estado del producto actualizado con éxito!');
    }

    // 5. Actualización rápida en línea vía AJAX (Incluye nombre, categoría, precio, stock e imagen)
    public function updateFast(Request $request, $id)
    {
        // 1. Validamos los datos que llegan por AJAX
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Max 2MB
        ]);

        // 2. Buscamos el producto
        $producto = Producto::findOrFail($id);

        // 3. Actualizamos los campos de texto
        $producto->nombre = $request->nombre;
        $producto->categoria_id = $request->categoria_id;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;

        // Variables para controlar si devolvemos una nueva URL de imagen
        $imagenUrl = null;

        // 4. Si el usuario subió una imagen nueva, la procesamos
        if ($request->hasFile('imagen')) {
            
            // Eliminamos la imagen anterior si es que tenía una física guardada
            if ($producto->imagen) {
                $rutaAnterior = public_path('uploads/productos/' . $producto->imagen);
                if (File::exists($rutaAnterior)) {
                    File::delete($rutaAnterior);
                }
            }

            // Guardamos la nueva imagen con un nombre único basado en el tiempo
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            
            // Mueve el archivo a public/uploads/productos/
            $imagen->move(public_path('uploads/productos'), $nombreImagen);

            // Guardamos el nombre en la base de datos
            $producto->imagen = $nombreImagen;
            
            // Generamos la URL completa para que JavaScript la pinte al instante
            $imagenUrl = asset('uploads/productos/' . $nombreImagen);
        }

        // 5. Guardamos todos los cambios en la base de datos
        $producto->save();

        // 6. Respondemos con éxito al JS en la vista
        return response()->json([
            'success' => true,
            'message' => 'Producto actualizado correctamente.',
            'imagen_url' => $imagenUrl
        ]);
    }

    public function catalogoCliente()
    {
        // Trae todos los productos de la base de datos (con su categoría relacionada)
        $productos = Producto::with('categoria')->get();

        // Entra a la carpeta 'frontend' y busca el archivo 'productosClientes'
        return view('frontend.productosClientes', compact('productos')); 
    }
}