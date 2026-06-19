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
        
        // 1. Guardamos el mensaje en la sesión de forma segura
        session()->flash('success', '¡Helado agregado al carrito con éxito!');
        
        // 2. Volvemos exactamente a la misma página donde el usuario hizo clic
        return redirect()->back();
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

    public function vaciar()
    {
        // 1. Buscamos la cabecera activa usando el estado real de tu base de datos: 'pendiente'
        $carrito = VentaCabecera::where('user_id', auth()->id())
                                ->where('estado', 'pendiente') 
                                ->first();

        if ($carrito) {
            // 2. Borramos todos los helados (detalles) vinculados a esta cabecera
            $carrito->detalles()->delete();
            
            // 3. Reiniciamos el total de la cabecera a 0
            $carrito->update(['total' => 0]);
        }

        // 4. Devolvemos al cliente a la vista con el cartel verde
        return redirect()->back()->with('success', '¡El carrito se vació por completo!');
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
        // 1. Validaciones estrictas y 100% en español (las que arreglamos recién)
        $request->validate([
            'dni'          => 'required|regex:/^[0-9]+$/|digits_between:7,9',
            'telefono'     => 'required|regex:/^[0-9]+$/|digits_between:6,15',
            'tipo_entrega' => 'required|in:local,domicilio',
            'direccion'    => [
                'required_if:tipo_entrega,domicilio', 'nullable', 'string', 'max:255',
                'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s\.,\-#º°]+$/'
            ],
            'medio_pago'   => 'required_if:tipo_entrega,domicilio|nullable|not_in:0',
        ], [
            'dni.required'          => 'El DNI es obligatorio.',
            'dni.regex'             => 'El DNI solo puede contener números, sin espacios ni puntos.',
            'dni.digits_between'    => 'El DNI debe tener entre 7 y 9 números.',
            'telefono.required'     => 'El teléfono es obligatorio.',
            'telefono.regex'        => 'El teléfono solo puede contener números.',
            'telefono.digits_between' => 'El teléfono debe tener entre 6 y 15 números.',
            'tipo_entrega.required' => 'Debés seleccionar una forma de entrega.',
            'direccion.required_if' => 'La dirección es obligatoria cuando elegís envío a domicilio.',
            'direccion.regex'       => 'La dirección contiene símbolos no permitidos.',
            'medio_pago.required_if'=> 'Debés seleccionar un medio de pago para el envío.',
            'medio_pago.not_in'     => 'Seleccioná un medio de pago válido.',
        ]);

        // 2. Buscamos el carrito activo del usuario
        $venta = \App\Models\VentaCabecera::where('user_id', auth()->id())
                              ->where('estado', 'pendiente')
                              ->first();

        if (!$venta || $venta->detalles->isEmpty()) {
            return redirect()->route('catalogo.publico')->with('error', 'No tenés productos en el carrito.');
        }

        // 🌟 3. EL TRUCO MÁGICO: DESCONTAR EL STOCK
        foreach ($venta->detalles as $detalle) {
            $producto = $detalle->producto;
            
            // Validación extra de seguridad: ¿Qué pasa si otro cliente compró el último mientras este dudaba?
            if ($producto->stock < $detalle->cantidad) {
                return redirect()->back()->with('error', 'Ups, nos quedamos sin stock suficiente de: ' . $producto->nombre);
            }

            // Descontamos la cantidad y guardamos en la base de datos
            $producto->stock -= $detalle->cantidad;
            $producto->save();
        }

        // 4. Modificamos los datos de la cabecera y cerramos la venta
        $venta->dni = $request->dni;
        $venta->telefono = $request->telefono;
        $venta->tipo_entrega = $request->tipo_entrega;
        
        $venta->direccion = $request->tipo_entrega == 'domicilio' ? $request->direccion : 'Retiro en Local';
        $venta->medio_pago = $request->tipo_entrega == 'domicilio' ? $request->medio_pago : 'Pago en caja (Local)';
        
        $venta->estado = 'completado'; 
        $venta->fecha_venta = now();   
        $venta->save();

        // 5. Redireccionamos limpio a la pantalla del comprobante
        return redirect()->route('carrito.comprobante', $venta->id)->with('success', '¡Compra finalizada con éxito!');
    }

    // Muestra la pantalla final del Comprobante de Venta
    public function mostrarComprobante($id)
    {
        // Traemos la cabecera con sus relaciones para no hacer consultas de más
        $venta = VentaCabecera::with('detalles.producto', 'user')->findOrFail($id);
        
        // Control de seguridad básico: Un cliente no puede espiar el comprobante de otro
        if ($venta->user_id !== auth()->id()) {
            abort(403, 'No tenés autorización para ver este comprobante.');
        }

        return view('frontend.comprobante', compact('venta'));
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