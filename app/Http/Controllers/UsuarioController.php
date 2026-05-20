<?php

namespace App\Http\Controllers;
<<<<<<< HEAD
=======
use App\Models\Rol;
>>>>>>> bc2483854b38680d731d03e84f671f683e59de0f

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
<<<<<<< HEAD
        //
=======
        $usuarios = Usuario::with('rol')->get();
        return view('usuarios.index', compact('usuarios'));

>>>>>>> bc2483854b38680d731d03e84f671f683e59de0f
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
<<<<<<< HEAD
        //
=======
        $roles = Rol::all(); // necesario para el <select> del formulario
        return view('usuarios.create', compact('roles'));
>>>>>>> bc2483854b38680d731d03e84f671f683e59de0f
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        //
=======
        $request->validate([
        'nombre' => 'required|string|max:100',
        'email' => 'required|email|unique:usuarios',
        'password' => 'required|min:8|confirmed', // busca campo password_confirmation
        'rol_id' => 'required|exists:roles,id',
    ]);
    Usuario::create($request->only(['nombre', 'email', 'password', 'rol_id']));
    return redirect()->route('usuarios.index')->with('exito', 'Usuario registrado.');
>>>>>>> bc2483854b38680d731d03e84f671f683e59de0f
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
<<<<<<< HEAD
        //
=======
        $usuario->delete(); // borrado lógico
        return redirect()->route('usuarios.index')->with('exito', 'Usuario dado de baja.');
>>>>>>> bc2483854b38680d731d03e84f671f683e59de0f
    }
}
