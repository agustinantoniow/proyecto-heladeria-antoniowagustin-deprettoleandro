<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;      
use App\Models\VentaCabecera; 
use App\Models\VentaDetalle;   
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; // <-- 1. ASEGÚRATE DE QUE ESTA LÍNEA ESTÉ ARRIBA DE TODO
class CarritoController extends Controller
{
    /**
     * Helper privado para obtener o crear el carrito activo del usuario.
     * OJO: Requiere que el usuario esté autenticado.
     */
    private function obtenerCarrito()
    {
        $usuario = auth()->user();

        // Busca un carrito pendiente de este usuario o lo crea si no existe
        return VentaCabecera::firstOrCreate([
            'user_id' => $usuario->id,
            'estado'  => 'pendiente'
        ]);
    }
    
    // 5.2 — ver el carrito
    public function index()
    {
        // Si quieres proteger que solo usuarios logueados lo vean:
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tu carrito.');
        }

        $carrito = $this->obtenerCarrito();
        $items = $carrito->detalles()->with('producto')->get();
        
        // Apunta a tu vista 'resources/views/frontend/Carrito.blade.php'
        return view('frontend.Carrito', compact('carrito', 'items'));
    }

    // 5.3 — agregar producto desde el catálogo
  public function agregar(Request $request)
{
    // 1. Validar que el usuario esté logueado antes de comprar
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para agregar productos al carrito.');
    }

    // 2. Validar los datos que vienen del formulario (eliminamos el min:1 para aceptar el -1 de la vista)
    $request->validate([
        'producto_id' => 'required|exists:productos,id',
        'cantidad'    => 'required|integer',
    ]);

    $producto = Producto::findOrFail($request->producto_id);
    
    if (!$producto->activo) {
        return redirect()->back()->with('error', 'Lo sentimos, este producto se encuentra pausado temporalmente.');
    }

    $carrito = $this->obtenerCarrito();
    
    // Buscamos si el helado ya estaba en este carrito pendiente
    $item = $carrito->detalles()->where('producto_id', $producto->id)->first();

    // Guardamos la cantidad que mandó la vista (puede ser 1, 2, o -1 desde el carrito)
    $cantidadModificar = (int)$request->cantidad;

    if ($item) {
        if ($cantidadModificar < 0) {
            // LÓGICA PARA RESTAR UNIDAD (Cuando la vista manda cantidad = -1)
            if ($item->cantidad > 1) {
                $item->cantidad -= 1; // Restamos 1 unidad fija de forma segura
            } else {
                return back()->with('error', 'La cantidad mínima es 1. Si no lo deseas, puedes eliminarlo.');
            }
        } else {
            // LÓGICA PARA SUMAR UNIDAD (Catálogo o botón "+" del carrito)
            if ($producto->stock < ($item->cantidad + $cantidadModificar)) {
                return back()->with('error', 'No podés agregar esa cantidad. Supera el stock disponible.');
            }
            $item->cantidad += $cantidadModificar;
        }

        // Recalculamos el subtotal de este helado multiplicando por su precio
        $item->subtotal = $item->cantidad * $item->precio_unitario;
        $item->save();
    } else {
        // SI ES NUEVO EN EL CARRITO
        // Si por alguna razón intenta restar un producto que no existe en el carrito, lo frenamos
        if ($cantidadModificar < 0) {
            return back()->with('error', 'Operación no válida.');
        }

        // Validar Stock real de la base de datos para el nuevo ítem
        if ($producto->stock < $cantidadModificar) {
            return back()->with('error', 'No hay suficiente stock disponible de ' . $producto->nombre);
        }

        // Creamos el detalle vinculando el precio actual del producto
        $carrito->detalles()->create([
            'producto_id'     => $producto->id,
            'cantidad'        => $cantidadModificar,
            'precio_unitario' => $producto->precio,
            'subtotal'        => $producto->precio * $cantidadModificar,
        ]);
    }

    // Actualizamos el total general de la cabecera del carrito
    $this->recalcularTotal($carrito);
    
    return back()->with('success', '¡Carrito actualizado con éxito!');
}

    // 5.4 — eliminar / quitar un producto del carrito
    public function eliminar($id)
    {
        $carrito = $this->obtenerCarrito();
        
        // Eliminamos usando el ID del detalle
        $carrito->detalles()->where('id', $id)->delete();
        
        $this->recalcularTotal($carrito);
        
        return back()->with('success', 'Producto quitado del carrito.');
    }

    // 5.5 — confirmar la compra y descontar stock
    public function confirmar()
    {
        $carrito = $this->obtenerCarrito();
        
        if ($carrito->detalles()->count() === 0) {
            return back()->with('error', 'Tu carrito está vacío.');
        }

        $items = $carrito->detalles()->with('producto')->get();
        
        // REQUISITO CRÍTICO: Restar el stock físico de tus helados antes de cerrar la venta
        foreach ($items as $item) {
            $producto = $item->producto;
            if ($producto->stock < $item->cantidad) {
                return back()->with('error', 'Lo sentimos, el producto ' . $producto->nombre . ' se quedó sin stock suficiente.');
            }
            // Descontamos las unidades compradas
            $producto->decrement('stock', $item->cantidad);
        }

        $total = $carrito->total;

        // Cambia estado de 'pendiente' a 'confirmado' y guarda la fecha exacta
        $carrito->update([
            'estado'      => 'confirmado',
            'fecha_venta' => now(),
        ]);

        // Pasa los datos por sesión a la vista de confirmación final
        return redirect()->route('compra.confirmada')
                         ->with('items', $items)
                         ->with('total', $total);
    }

    // 5.6 — helper privado para mantener actualizado el costo total
    private function recalcularTotal(VentaCabecera $carrito)
    {
        $total = $carrito->detalles()->sum('subtotal');
        $carrito->update(['total' => $total]);
    }
    public function checkout()
{
    $carrito = $this->obtenerCarrito();
    $items = $carrito->detalles;

    // Si el carrito está vacío, lo devolvemos al catálogo
    if ($items->isEmpty()) {
        return redirect()->route('catalogo.publico')->with('error', 'Tu carrito está vacío.');
    }

    return view('frontend.checkout', compact('carrito', 'items'));
}

public function mostrarFormularioPago() // Supongo que este es el nombre del método en la línea 186
{
    // 1. Recuperamos el carrito usando tu método existente
    $carrito = $this->obtenerCarrito();

    // 2. Retornamos la nueva vista del formulario pasándole el carrito
    return view('frontend.formularioPago', compact('carrito'));
}
public function procesarCompra(Request $request)
{
    // Validamos que el usuario haya elegido las opciones
    $request->validate([
        'tipo_entrega' => 'required|in:local,domicilio',
        'metodo_pago' => 'required|in:efectivo,tarjeta,mercadopago'
    ]);

    $carrito = $this->obtenerCarrito();

    // Generamos una palabra clave única de 6 caracteres (ej: A9F3K1)
    $palabraClave = 'GLACE-' . strtoupper(Str::random(6));

    // Cambiamos el estado de la venta
    $carrito->estado = 'completado';
    
    // Opcional: Si agregás estas columnas a tu tabla venta_cabeceras, descomentá esto:
    // $carrito->tipo_entrega = $request->tipo_entrega;
    // $carrito->metodo_pago = $request->metodo_pago;
    // $carrito->codigo_retiro = $palabraClave;
    
    $carrito->save();

    // Redirigimos a una vista de éxito pasándole los datos
    return view('frontend.compraExitosa', compact('carrito', 'palabraClave', 'request'));
}
public function procesar(Request $request)
{
    // 1. Validar los datos que vienen del formulario dinámico
    $request->validate([
        'tipo_entrega' => 'required|in:local,domicilio',
        'metodo_pago' => 'required|in:efectivo,tarjeta,mercadopago',
        // Validar teléfono y dirección solo si es a domicilio
        'telefono' => 'required_if:tipo_entrega,domicilio',
        'direccion' => 'required_if:tipo_entrega,domicilio',
    ]);

    // 2. Obtener el carrito/venta pendiente del usuario actual
    $carrito = $this->obtenerCarrito(); 

    if (!$carrito) {
        return redirect()->route('carrito.index')->with('error', 'No tienes un carrito activo.');
    }

    // 3. Guardar los datos del formulario en la cabecera de la venta
    $carrito->tipo_entrega = $request->tipo_entrega;
    $carrito->metodo_pago = $request->metodo_pago;
    
    if ($request->tipo_entrega === 'domicilio') {
        $carrito->telefono = $request->telefono;
        $carrito->direccion = $request->direccion;
    }

    // 4. CAMBIO CLAVE PARA EL HISTORIAL: Marcar como completada
    // Al pasar a 'completado', ya sale del "carrito activo" y entra a los historiales
    $carrito->estado = 'completado'; 
    $carrito->fecha_compra = now(); // Si tienes un campo de fecha personalizado
    $carrito->save();

    // 5. Redirigir a la vista de éxito que creamos recién
    return view('frontend.compraExitosa', compact('carrito'));
}
public function misCompras()
    {
        // Traemos directamente desde la base de datos los detalles de las compras de este usuario
        $compras = DB::table('venta_detalles')
            ->join('venta_cabeceras', 'venta_detalles.venta_cabecera_id', '=', 'venta_cabeceras.id')
            ->join('productos', 'venta_detalles.producto_id', '=', 'productos.id')
            ->leftJoin('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->where('venta_cabeceras.user_id', '=', auth()->id()) // Filtra que pertenezca al usuario logueado
            ->where('venta_cabeceras.estado', '=', 'completado') // Filtra que la compra esté confirmada/pagada
            ->select(
                'venta_cabeceras.id as cabecera_id',
                'venta_cabeceras.updated_at as fecha_pago',
                'venta_detalles.cantidad as cantidad',
                'venta_detalles.precio_unitario as precio_unitario',
                'venta_detalles.subtotal as subtotal',
                'productos.nombre as producto_nombre',
                'productos.imagen as producto_imagen',
                'categorias.nombre as categoria_nombre'
            )
            ->orderBy('venta_detalles.id', 'desc') // Muestra lo más reciente primero
            ->get();

        // Le enviamos la variable $compras en plural a tu archivo Blade
        return view('frontend.mis_compras', compact('compras')); // Ajusta la ruta de la vista si es necesario
    }
    public function listarVentasAdmin()
{
    // Consulta limpia directa a la base de datos
    $ventas = \Illuminate\Support\Facades\DB::table('venta_detalles')
        ->join('venta_cabeceras', 'venta_detalles.venta_cabecera_id', '=', 'venta_cabeceras.id')
        ->join('productos', 'venta_detalles.producto_id', '=', 'productos.id')
        ->leftJoin('categorias', 'productos.categoria_id', '=', 'categorias.id')
        ->where('venta_cabeceras.estado', '=', 'completado')
        ->select(
            'venta_detalles.id as detalle_id',
            'venta_cabeceras.id as cabecera_id',
            'venta_cabeceras.updated_at as fecha_pago',
            'venta_detalles.cantidad as cantidad',
            'venta_detalles.precio_unitario as precio_unitario',
            'venta_detalles.subtotal as subtotal',
            'productos.nombre as producto_nombre',
            'productos.imagen as producto_imagen',
            'categorias.nombre as categoria_nombre'
        )
        ->orderBy('venta_detalles.id', 'desc')
        ->get();

    // AQUÍ SE DEFINE LA VARIABLE QUE LA VISTA RECLAMA EN LA LÍNEA 11
    $totalVentas = $ventas->count();

    // Retornamos la vista enviándole obligatoriamente las dos variables que necesita
    return view('backend.admin.ventas', compact('ventas', 'totalVentas'));
}
}