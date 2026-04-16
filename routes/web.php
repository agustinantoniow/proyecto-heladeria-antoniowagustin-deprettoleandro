<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.heladeriaglace');
});
Route::get('/TerminosyUsos', function () {
    return view('frontend.TerminosyUsos');
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
Route::get('/Contacto', function () {
    return view('frontend.Contacto');
});
 Route::get('/Comercializacion', function () {
    return view('frontend.Comercializacion');
});
 Route::get('/Productos', function () {
    return view('frontend.Productos');
});
 
 