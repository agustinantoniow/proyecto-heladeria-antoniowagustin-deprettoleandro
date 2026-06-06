<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUsuarioController extends Controller
{
    // 1. Listar usuarios
    public function index()
    {
        $usuarios = Usuario::all();
        return view('backend.admin.usuarios.index', compact('usuarios'));
    }

    // 2. Guardar un nuevo usuario desde el panel
    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email'    => 'required|email|unique:usuarios,email',
            'usuario'  => 'required|string|unique:usuarios,usuario|max:255',
            'password' => 'required|string|min:4',
            'perfil_id'=> 'required|integer'
        ]);

        Usuario::create([
            'nombre'    => $request->nombre,
            'apellido'  => $request->apellido,
            'email'     => $request->email,
            'usuario'   => $request->usuario,
            'password'  => Hash::make($request->password),
            'perfil_id' => $request->perfil_id,
            'estado'    => true
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    // 3. Actualizar datos de un usuario existente
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre'   => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email'    => 'required|email|unique:usuarios,email,' . $id,
            'usuario'  => 'required|string|unique:usuarios,usuario,' . $id,
            'perfil_id'=> 'required|integer'
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->email = $request->email;
        $usuario->usuario = $request->usuario;
        $usuario->perfil_id = $request->perfil_id;

        // Si el admin escribió una nueva contraseña, se actualiza
        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:4']);
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado con éxito.');
    }

    // 4. Alternar Estado (Dar de baja / Reactivar)
    public function toggleStatus($id)
    {
        $usuario = Usuario::findOrFail($id);
        
        // Evitar que el admin se dé de baja a sí mismo
        if (auth()->user()->id == $usuario->id) {
            return redirect()->route('admin.usuarios.index')->with('error', 'No podés darte de baja a vos mismo.');
        }

        // Invierte el estado actual
        $usuario->estado = !$usuario->estado;
        $usuario->save();

        $mensaje = $usuario->estado ? 'Usuario reactivado.' : 'Usuario dado de baja correctamente.';
        return redirect()->route('admin.usuarios.index')->with('success', $mensaje);
    }
}