<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // 1. Listar las categorías existentes
    public function index()
    {
        $categorias = Categoria::all();
        return view('backend.admin.categorias.index', compact('categorias'));
    }

    // 2. Mostrar el formulario de creación
    public function create()
    {
        return view('backend.admin.categorias.create');
    }

    // 3. Guardar la nueva categoría en la Base de Datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
        ]);

        Categoria::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('admin.categorias.index')->with('success', '¡Categoría creada con éxito!');
    }
}