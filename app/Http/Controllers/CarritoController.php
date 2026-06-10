<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;      
use App\Models\VentaCabecera; 
use App\Models\VentaDetalle;   
use Illuminate\Support\Facades\Auth;

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
}