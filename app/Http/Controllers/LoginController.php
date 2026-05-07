<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest; // No te olvides de importar el Request que creamos arriba
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
{
    // Usamos el punto para entrar a la carpeta
    return view('frontend.login'); 
}

    public function store(LoginRequest $request)
    {
        // Si llegamos acá, es porque el paso 1 fue exitoso
        $credenciales = $request->validated();

        // Lógica de ejemplo: (Acá después conectarás con la base de datos)
        // if (Auth::attempt($credenciales)) { ... }

        return redirect()->url('/Productos')->with('success', '¡Hola de nuevo!');
    }
}
