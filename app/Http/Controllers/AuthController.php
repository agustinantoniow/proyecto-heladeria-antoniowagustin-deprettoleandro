<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function formularioRegistro()
    {
        return view('Backend.usuarios.registro');
    }
    public function formularioLogin(){
        return view ('Backend.usuarios.login');
    }
    public function registrar (Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
    }
// Valida que lleguen el email y la password
public function autenticar(Request $request)
{
    $credenciales = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Auth::attempt() busca el usuario en la BD y compara la contraseña
    if (Auth::attempt($credenciales)) {
        $request->session()->regenerate();
        
        // Verifica el rol del usuario para redireccionarlo
        if (Auth::user()->rol === 'admin') {
            return redirect('/admin');
        }
        
        return redirect('/cliente'); // Si no es admin, es cliente
    }

    // Si las credenciales no coinciden, vuelve atrás con un error
    return  back()->withErrors([
        'email' => 'Email o contraseña incorrectos'
    ]);
}
public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}
}