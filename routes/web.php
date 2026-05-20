<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
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

// Route::get('/Productos', function () {
  //  return view('frontend.Productos');
//});

Route::get('/login', function () {
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



// 1. Ruta para VER el formulario (La que ya tenés)
Route::get('/login', [LoginController::class, 'index'])->name('login');

// 2. Ruta para PROCESAR el formulario (La que te falta)
// ¡Esta tiene que ser POST!
Route::post('/login', [LoginController::class, 'store']);
<<<<<<< HEAD

use App\Http\Controllers\ProductoController;

// La ruta de tipo resource que maneja las 7 funciones del CRUD automáticamente

Route::resource('productos', ProductoController::class);
=======
Route::get('/login', [AuthController::class, 'formularioLogin']);
Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin',[AdminController::class,'dashboard']); 
});
>>>>>>> bc2483854b38680d731d03e84f671f683e59de0f
