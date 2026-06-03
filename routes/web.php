<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CarritoController;

Route::get('/', function () {
    return view('frontend.heladeriaglaceVisitante');
});
Route::get('/Cliente', function () {
    return view('frontend.heladeriaglaceCliente');
});
Route::get('/terminosYusos', function () {
    return view('frontend.terminosYusos');
});
Route::get('/terminosyusoCliente', function () {
    return view('frontend.terminosyusoCliente');
});
 Route::get('/QuienesSomos', function () {
    return view('frontend.QuienesSomos');
});
Route::get('/QuienesSomosCliente', function () {
    return view('frontend.QuienesSomosCliente');
});
 Route::get('/Consultas', function () {
    return view('frontend.Consultas');
});
 Route::get('/ConsultasCliente', function () {
    return view('frontend.ConsultasCliente');
});

Route::get('/ProductosCliente', [ProductoController::class, 'index'])->name('productosCliente.index');
Route::get('/', function () {
    return view('frontend.heladeriaglaceVisitante');
});

    Route::get('/Productos', function () {
    return view('frontend.Productos');
});

Route::get('/contacto', function () {
    return view('frontend.contacto');
});
Route::get('/contactoCliente', function () {
    return view('frontend.contactoCliente');
});
 Route::get('/Comercializacion', function () {
    return view('frontend.Comercializacion');
});
Route::get('/ComercializacionCliente', function () {
    return view('frontend.ComercializacionCliente   ');
});
Route::get('/Ingreso', function () {
    return view('frontend.login');
});
Route::get('/ver mas...', function () {
    return view('frontend.paginaHeladosAgua');
});

Route::get('/ver mas...Cliente', function () {
    return view('frontend.paginaHeladosAguaCliente');
});

Route::get('/ver mas....', function () {
    return view('frontend.pagina-postres');
});
Route::get('/ver mas....Cliente', function () {
    return view('frontend.pagina-postresCliente');
});
 Route::get('/ver mas..', function () {
    return view('frontend.pagina-lineafamiliar');
});
Route::get('/ver mas..Cliente', function () {
    return view('frontend.pagina-lineaFamiliarCliente');
});
 Route::get('/registrarse', function () {
    return view('frontend.registrarse');
});
 Route::get('/exito', function () {
    return view('frontend.exito');
});
 Route::get('/exitoCliente', function () {
    return view('frontend.exitoCliente');
});
Route::get('/MiCarrito', function () {
    return view('frontend.Carrito');
});
Route::get('/dashboard  ', function () {
    return view('backend.admin.dashboard');
});



// Esta es para mostrar el formulario
Route::get('/registro', [UsuarioController::class, 'create'])->name('registro');

// ¡ESTA ES LA QUE CAUSA EL ERROR! Asegurate de que tenga el ->name('registro.store')
Route::post('/registro', [UsuarioController::class, 'store'])->name('registro.store');

Route::get('/login', [UsuarioController::class, 'showLoginForm'])->name('login');
// 2. Procesar el intento de inicio de sesión (POST)

Route::post('/verificarUsuario', [UsuarioController::class, 'login'])->name('login.autenticar');
// 3. Cerrar sesión (POST)

Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');
// 4. Procesar el formulario de creación de cuenta (POST)
Route::post('/formregister', [UsuarioController::class, 'store_usuarios'])->name('formregister');

Route::get('/Consultas', [ConsultaController::class, 'index']);   // muestra el form
Route::post('/Consultas', [ConsultaController::class, 'store']);  // procesa el form   

Route::middleware(['auth', 'rol:cliente'])->group(function () {
    
    // Mostrar el carrito
    Route::get('/carrito', [CarritoController::class, 'index'])
        ->name('cliente.carrito');

    // Agregar un producto
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])
        ->name('carrito.agregar');

    // Eliminar un producto
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])
        ->name('carrito.eliminar');

    // Confirmar la compra
    Route::post('/carrito/confirmar', [CarritoController::class, 'confirmar'])
        ->name('carrito.confirmar');

    // Vista de compra confirmada (protegida: redirige si no hay sesión)
    Route::get('/compra-confirmada', function () {
        if (!session('total')) {
            return redirect()->route('cliente.dashboard');
        }
        return view('frontend.compra-confirmada');
    })->name('compra.confirmada');

});
Route::middleware(['auth'])->group(function () {
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
});
