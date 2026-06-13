<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\PerfilController;
// Controladores de Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUsuarioController;
use App\Http\Controllers\Admin\ProductoController as AdminProductoController;
use App\Http\Controllers\Admin\CategoriaController as AdminCategoriaController;

/*
|--------------------------------------------------------------------------
| 1. VISTAS PÚBLICAS Y FRONTIER (Visitantes / Clientes sin loguear)
|--------------------------------------------------------------------------
*/

// Home e Institucionales
Route::get('/', function () { return view('frontend.heladeriaglaceVisitante'); })->name('home');
Route::get('/QuienesSomos', function () { return view('frontend.QuienesSomos'); })->name('quienes_somos');
Route::get('/Comercializacion', function () { return view('frontend.Comercializacion'); });
Route::get('/terminosYusos', function () { return view('frontend.terminosYusos'); });

// Contacto y Consultas Públicas
Route::get('/Consultas', function () { return view('frontend.Consultas'); });
Route::post('/Consultas', [ConsultaController::class, 'store'])->name('consultas.store');
Route::get('/contacto', function () { return view('frontend.contacto'); });

// --- EL CATÁLOGO PÚBLICO Y DINÁMICO DE PRODUCTOS ---
// Esta es la ÚNICA ruta que necesitas para mostrar los helados a los visitantes
Route::get('/productos', [AdminProductoController::class, 'catalogoCliente'])->name('catalogo.publico');


// Secciones "Ver Más..." de Categorías Públicas
Route::get('/ver mas...', function () { return view('frontend.paginaHeladosAgua'); });
Route::get('/ver mas....', function () { return view('frontend.pagina-postres'); });
Route::get('/ver mas..', function () { return view('frontend.pagina-lineafamiliar'); });


/*
|--------------------------------------------------------------------------
| 2. AUTENTICACIÓN Y REGISTRO (Login, Logout y Registro)
|--------------------------------------------------------------------------
*/
Route::get('/Ingreso', function () { return view('frontend.heladeriaGlaceVisitante'); });
Route::get('/login', [UsuarioController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UsuarioController::class, 'login'])->name('login.autenticar');
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');

Route::get('/registrarse', function () { return view('frontend.registrarse'); });
Route::get('/registro', [UsuarioController::class, 'create'])->name('registro');
Route::post('/registro', [UsuarioController::class, 'store'])->name('registro.store');
Route::post('/formregister', [UsuarioController::class, 'store_usuarios'])->name('formregister');
Route::get('/exito', function () { return view('frontend.exito'); });


/*
|--------------------------------------------------------------------------
| 3. CAPA CLIENTE LOGUEADO (Middleware Auth / Rol Cliente)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // Perfil del cliente
    Route::get('/perfil', [PerfilController::class, 'ver'])->name('perfil.ver');
    Route::put('/perfil/actualizar', [PerfilController::class, 'actualizar'])->name('perfil.actualizar');

    // Vistas exclusivas del Cliente con sesión activa
    Route::get('/Cliente', [ClienteController::class, 'index'])->name('frontend.heladeriaGlaceCliente');
    Route::get('/terminosyusoCliente', function () { return view('frontend.terminosyusoCliente'); });
    Route::get('/QuienesSomosCliente', function () { return view('frontend.QuienesSomosCliente'); });
    Route::get('/ConsultasCliente', function () { return view('frontend.ConsultasCliente'); });
    Route::get('/contactoCliente', function () { return view('frontend.contactoCliente'); });
    Route::get('/ComercializacionCliente', function () { return view('frontend.ComercializacionCliente'); });
    Route::get('/exitoCliente', function () { return view('frontend.exitoCliente'); });
    
    // --- CATÁLOGO PARA CLIENTES LOGUEADOS ---
    // Usamos la misma lógica del controlador para mostrar los productos, pero con otro nombre de ruta si lo necesitas
    Route::get('/cliente/productos', [AdminProductoController::class, 'catalogoCliente'])->name('ProductosCliente');

    // Rutas dinámicas por categorías
    Route::get('/categoria/{slug}', [CatalogoController::class, 'mostrarCategoria'])->name('categoria.mostrar');
    Route::get('/catalogo/categoria/{id}', [CatalogoController::class, 'porCategoria'])->name('catalogo.categoria');

    // Ver más categorías versión Cliente
    Route::get('/ver mas...Cliente', function () { return view('frontend.paginaHeladosAguaCliente'); });
    Route::get('/ver mas....Cliente', function () { return view('frontend.pagina-postresCliente'); });
    Route::get('/ver mas..Cliente', function () { return view('frontend.pagina-lineaFamiliarCliente'); });



   
    // Gestión de Carrito de Compras
    Route::get('/MiCarrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::get('/carrito', [CarritoController::class, 'index'])->name('cliente.carrito');
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::post('/carrito/confirmar', [CarritoController::class, 'confirmar'])->name('carrito.confirmar');
    Route::get('/compra-confirmada', function () {
        if (!session('total')) return redirect('/Cliente');
        return view('frontend.compra-confirmada');
    })->name('compra.confirmada');
});


/*
|--------------------------------------------------------------------------
| 4. CAPA ADMINISTRADOR (Middleware Auth + AdminMiddleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    
    // Dashboard Inicial
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Gestión de Consultas del Admin
    Route::get('/admin/consultas', [AdminController::class, 'index'])->name('admin.consultas');
    Route::patch('/admin/consultas/{id}/leido', [AdminController::class, 'marcarLeido'])->name('consultas.marcarLeido');
    Route::delete('/admin/consultas/{id}', [AdminController::class, 'destroy'])->name('consultas.destroy');

    // Gestión de Usuarios Admin
    Route::get('/admin/usuarios', [AdminUsuarioController::class, 'index'])->name('admin.usuarios.index');
    Route::post('/admin/usuarios', [AdminUsuarioController::class, 'store'])->name('admin.usuarios.store');
    Route::put('/admin/usuarios/{id}', [AdminUsuarioController::class, 'update'])->name('admin.usuarios.update');
    Route::patch('/admin/usuarios/{id}/toggle', [AdminUsuarioController::class, 'toggleStatus'])->name('admin.usuarios.toggle');
   
    // 🍦 INVENTARIO DE PRODUCTOS (ADMIN)
    Route::get('/admin/Productos', [AdminProductoController::class, 'index'])->name('admin.productos.index');
    Route::get('/admin/Productos/create', [AdminProductoController::class, 'create'])->name('admin.productos.create');
    Route::post('/admin/Productos', [AdminProductoController::class, 'store'])->name('admin.productos.store');
    Route::patch('/admin/productos/{producto}/toggle-status', [AdminProductoController::class, 'toggleStatus'])->name('admin.productos.toggleStatus');
    Route::patch('/admin/productos/{id}/update-fast', [AdminProductoController::class, 'updateFast'])->name('admin.productos.updateFast');
    Route::delete('/admin/productos/{id}', [AdminProductoController::class, 'destroy'])->name('admin.productos.destroy');
   
    // Gestión de Categorías Admin
    Route::get('/admin/categorias', [AdminCategoriaController::class, 'index'])->name('admin.categorias.index');
    Route::get('/admin/categorias/create', [AdminCategoriaController::class, 'create'])->name('admin.categorias.create');
    Route::post('/admin/categorias', [AdminCategoriaController::class, 'store'])->name('admin.categorias.store');
});

// Pantalla para elegir envío y pago
Route::get('/checkout', [CarritoController::class, 'checkout'])->name('carrito.checkout');

// Procesar la compra y generar la palabra clave
Route::post('/checkout/procesar', [CarritoController::class, 'procesarCompra'])->name('carrito.procesar');