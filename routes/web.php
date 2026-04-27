<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultasController;

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
 Route::get('/Productos', function () {
    return view('frontend.Productos');
});
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