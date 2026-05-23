<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;


Route::get('/', function () {
    return view('frontend.heladeriaglace');
});
Route::get('/terminosYusos', function () {
    return view('frontend.terminosYusos');
});
 Route::get('/QuienesSomos', function () {
    return view('frontend.QuienesSomos');
});
 Route::get('/Consultas', function () {
    return view('frontend.Consultas');
});
Route::get('/Nosotros', function () {
    return view('frontend.Nosotros');
});
Route::get('/contacto', function () {
    return view('frontend.contacto');
});
 Route::get('/Comercializacion', function () {
    return view('frontend.Comercializacion');
});

Route::get('/loginNavbar', function () {
    return view('frontend.login');
});
Route::get('/ver mas...', function () {
    return view('frontend.paginaHeladosAgua');
});

Route::get('/ver mas....', function () {
    return view('frontend.pagina-postres');
});
 Route::get('/ver mas..', function () {
    return view('frontend.pagina-lineafamiliar');
});
 Route::get('/registrarse', function () {
    return view('frontend.registrarse');
});
 Route::get('/exito', function () {
    return view('frontend.exito');
});



// Esta es para mostrar el formulario
Route::get('/registro', [UsuarioController::class, 'create'])->name('registro');

// ¡ESTA ES LA QUE CAUSA EL ERROR! Asegurate de que tenga el ->name('registro.store')
Route::post('/registro', [UsuarioController::class, 'store'])->name('registro.store');

// 1. Mostrar la vista del formulario (GET)
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
// 2. Procesar el intento de inicio de sesión (POST)
Route::post('/verificarUsuario', [LoginController::class, 'login'])->name('login.post');
// 3. Cerrar sesión (POST)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// 4. Procesar el formulario de creación de cuenta (POST)
Route::post('/formregister', [UsuarioController::class, 'store_usuarios'])->name('formregister');

Route::get('/Consultas', [ConsultaController::class, 'index']);   // muestra el form
Route::post('/Consultas', [ConsultaController::class, 'store']);  // procesa el form   