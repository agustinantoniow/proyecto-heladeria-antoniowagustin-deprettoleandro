<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;      
use App\Models\VentaCabecera; 
use App\Models\VentaDetalle;   
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // <-- Ya puesto en el lugar correcto
use Illuminate\Support\Facades\DB; 

class CarritoController extends Controller
{
    /**
     * Helper privado para obtener o crear el carrito activo del usuario.
     */
    private function obtenerCarrito()
    {
        $usuario = auth()->user();

        return VentaCabecera::firstOrCreate([
            'user_id' => $usuario->id,
            'estado'  => 'pendiente'
        ]);
    }
    
    // 1. Ver el carrito
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tu carrito.');
        }

        $carrito = $this->obtenerCarrito();
        $items = $carrito->detalles()->with('producto')->get();
        
        return view('frontend.Carrito', compact('carrito', 'items'));
    }

    // 2. Agregar producto desde el catálogo
    public function agregar(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para agregar productos al carrito.');
        }

        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer',
        ]);

        $producto = Producto::findOrFail($request->producto_id);
        
        if (!$producto->activo) {
            return redirect()->back()->with('error', 'Lo sentimos, este producto se encuentra pausado temporalmente.');
        }

        $carrito = $this->obtenerCarrito();
        $item = $carrito->detalles()->where('producto_id', $producto->id)->first();
        $cantidadModificar = (int)$request->cantidad;

        if ($item) {
            if ($cantidadModificar < 0) {
                if ($item->cantidad > 1) {
                    $item->cantidad -= 1; 
                } else {
                    return back()->with('error', 'La cantidad mínima es 1. Si no lo deseas, puedes eliminarlo.');
                }
            } else {
                if ($producto->stock < ($item->cantidad + $cantidadModificar)) {
                    return back()->with('error', 'No podés agregar esa cantidad. Supera el stock disponible.');
                }
                $item->cantidad += $cantidadModificar;
            }

            $item->subtotal = $item->cantidad * $item->precio_unitario;
            $item->save();
        } else {
            if ($cantidadModificar < 0) {
                return back()->with('error', 'Operación no válida.');
            }

            if ($producto->stock < $cantidadModificar) {
                return back()->with('error', 'No hay suficiente stock disponible de ' . $producto->nombre);
            }

            $carrito->detalles()->create([
                'producto_id'     => $producto->id,
                'cantidad'        => $cantidadModificar,
                'precio_unitario' => $producto->precio,
                'subtotal'        => $producto->precio * $cantidadModificar,
            ]);
        }

        $this->recalcularTotal($carrito);
        
        return back()->with('success', '¡Carrito actualizado con éxito!');
    }

    // 3. Eliminar / quitar un producto del carrito
    public function eliminar($id)
    {
        $carrito = $this->obtenerCarrito();
        $carrito->detalles()->where('id', $id)->delete();
        $this->recalcularTotal($carrito);
        
        return back()->with('success', 'Producto quitado del carrito.');
    }

    // 4. Helper privado para mantener actualizado el costo total
    private function recalcularTotal(VentaCabecera $carrito)
    {
        $total = $carrito->detalles()->sum('subtotal');
        $carrito->update(['total' => $total]);
    }

    // -------------------------------------------------------------
    // FLUJO DE CHECKOUT Y PAGO (Solicitado por el profesor)
    // -------------------------------------------------------------

    // 5. Mostrar la pantalla de Checkout
    public function checkout()
    {
        $carrito = $this->obtenerCarrito();
        $items = $carrito->detalles;

        if ($items->isEmpty()) {
            return redirect()->route('catalogo.publico')->with('error', 'Tu carrito está vacío.');
        }

        $venta = $carrito; // Le pasamos la variable con el nombre que espera tu vista
        return view('frontend.checkout', compact('carrito', 'items', 'venta'));
    }

    // 6. Procesar el formulario, descontar stock y cerrar la venta
    public function procesarCompra(Request $request)
    {
        // 1. Validamos los datos dinámicamente
        $request->validate([
            'dni' => 'required|numeric',
            'telefono' => 'required|string',
            'tipo_entrega' => 'required|in:local,domicilio',
            
            // La dirección solo es obligatoria si pide envío a domicilio
            'direccion' => 'required_if:tipo_entrega,domicilio|nullable|string',
            
            // El medio de pago solo es obligatorio si pide envío a domicilio
            'medio_pago' => 'required_if:tipo_entrega,domicilio|nullable|in:efectivo,tarjeta,mercadopago'
        ]);

        // ... acá sigue el resto de tu código (obtenerCarrito, descontar stock, etc.)
        $carrito = $this->obtenerCarrito();
        $items = $carrito->detalles()->with('producto')->get();

        if ($items->isEmpty()) {
            return redirect()->route('catalogo.publico')->with('error', 'Tu carrito está vacío.');
        }

        // Descontamos el stock físico
        foreach ($items as $item) {
            $producto = $item->producto;
            if ($producto->stock < $item->cantidad) {
                return back()->with('error', 'Lo sentimos, el producto ' . $producto->nombre . ' se quedó sin stock suficiente.');
            }
            $producto->decrement('stock', $item->cantidad);
        }

        // Generamos la palabra clave y guardamos los datos
        $palabraClave = 'GLACE-' . strtoupper(Str::random(6));

        $carrito->estado = 'completado';
        $carrito->dni = $request->dni;
        $carrito->telefono = $request->telefono;
        $carrito->tipo_entrega = $request->tipo_entrega;
        $carrito->direccion = $request->tipo_entrega === 'domicilio' ? $request->direccion : 'Retiro en sucursal';
        $carrito->metodo_pago = $request->medio_pago;
        $carrito->codigo_seguimiento = $palabraClave;
        $carrito->fecha_venta = now();
        $carrito->save();

        return redirect()->route('carrito.exito', $carrito->id);
    }

    // 7. Mostrar pantalla de "Compra Exitosa"
    public function exito($id_venta)
    {
        $venta = VentaCabecera::findOrFail($id_venta);

        if ($venta->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para ver esta compra.');
        }

        return view('frontend.exitoCliente', compact('venta'));
    }

    // 8. Mostrar el Comprobante/Ticket
    public function comprobante($id_venta)
    {
        $venta = VentaCabecera::with('detalles.producto')->findOrFail($id_venta);

        if ($venta->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para ver este comprobante.');
        }

        return view('frontend.comprobante', compact('venta'));
    }

    // -------------------------------------------------------------
    // HISTORIALES Y ADMINISTRACIÓN
    // -------------------------------------------------------------

    // 9. Historial de compras del cliente
    public function misCompras()
    {
        $compras = DB::table('venta_detalles')
            ->join('venta_cabeceras', 'venta_detalles.venta_cabecera_id', '=', 'venta_cabeceras.id')
            ->join('productos', 'venta_detalles.producto_id', '=', 'productos.id')
            ->leftJoin('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->where('venta_cabeceras.user_id', '=', auth()->id()) 
            ->where('venta_cabeceras.estado', '=', 'completado') 
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
            ->orderBy('venta_detalles.id', 'desc') 
            ->get();

        return view('frontend.mis_compras', compact('compras')); 
    }

    // 10. Listado de ventas para el Administrador
    public function listarVentasAdmin()
    {
        $ventas = DB::table('venta_detalles')
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

        $totalVentas = $ventas->count();

        return view('backend.admin.ventas', compact('ventas', 'totalVentas'));
    }
}