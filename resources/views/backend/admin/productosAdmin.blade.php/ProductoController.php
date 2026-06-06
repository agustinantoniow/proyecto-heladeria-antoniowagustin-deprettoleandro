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

        Producto::create([
            'nombre'       => $request->nombre,
            'categoria_id' => $request->categoria_id,
            'descripcion'  => $request->descripcion,
            'precio'       => $request->precio,
            'stock'        => $request->stock,
            'activo'       => true
        ]);

        return redirect()->route('admin.productos.index')->with('success', '¡Producto agregado con éxito!');
    }
}