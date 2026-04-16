<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultasController;

Route::get('/heladeriaglace', function () {
    return view('frontend.heladeriaglace');
});


Route::get('/terminosYusos', function(){
    return view('frontend.terminosYusos');
}); 

 Route::get('/recomendados', function () {
    return view('frontend.recomendados');
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


 