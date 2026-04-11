<?php

use Illuminate\Support\Facades\Route;

Route::get('/heladeriaglace', function () {
    return view('frontend.heladeriaglace');
});
Route::get('/TerminosyUsos', function () {
    return view('frontend.TerminosyUsos');
});
 
 