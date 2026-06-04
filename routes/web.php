<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\Admin\AdminController;

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

Route::post('/Consultas', [ConsultaController::class, 'store'])->name('consultas.store');

Route::get('/admin/consultas', [App\Http\Controllers\ConsultaController::class, 'index'])->name('admin.consultas');

// Ruta protegida para el Admin

Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    
    // El inicio del panel
    Route::get('/admin/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // La vista de la tabla
    Route::get('/admin/consultas', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.consultas');
    
    // --- ¡AGREGÁ ESTAS DOS RUTAS NUEVAS ACÁ! ---
    
    // Ruta para marcar como leída (usa el método PATCH)
    Route::patch('/admin/consultas/{id}/leido', [\App\Http\Controllers\Admin\AdminController::class, 'marcarLeido'])->name('consultas.marcarLeido');
    
    // Ruta para eliminar el mensaje (usa el método DELETE)
    Route::delete('/admin/consultas/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'destroy'])->name('consultas.destroy');
    
});

// Esta es la ruta que procesa el formulario cuando hacés clic en el botón
Route::post('/login', [LoginController::class, 'login']);
    