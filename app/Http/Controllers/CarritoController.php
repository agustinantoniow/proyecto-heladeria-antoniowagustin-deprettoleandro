<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;      // ⚠️ Requerido para agregar()
use App\Models\VentaCabecera; // ⚠️ Requerido para recalcularTotal()
use App\Models\VentaDetalle;   // ⚠️ Requerido para index() y confirmar()
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    // 5.2 — index() — ver el carrito
    private function obtenerCarrito()
{
    // Supongamos que usas autenticación y el usuario tiene un carrito activo 'pendiente'
    $usuario = auth()->user();

    // Busca un carrito pendiente de este usuario o lo crea si no existe
    return VentaCabecera::firstOrCreate([
        'user_id' => $usuario->id,
        'estado'  => 'pendiente'
    ]);
}
    
    public function index()
    {
        $carrito = $this->obtenerCarrito();
        $items = $carrito->detalles()->with('producto')->get();
        return view('frontend.Carrito', compact('carrito', 'items'));
    }

    // 5.3 — agregar() — agregar producto
    public function agregar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);
        
        if ($producto->stock < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock');
        }

        $carrito = $this->obtenerCarrito();
        $item = $carrito->detalles()->where('producto_id', $producto->id)->first();

        if ($item) {
            $item->cantidad += $request->cantidad;
            $item->subtotal = $item->cantidad * $item->precio_unitario;
            $item->save();
        } else {
            $carrito->detalles()->create([
                'producto_id'     => $producto->id,
                'cantidad'        => $request->cantidad,
                'precio_unitario' => $producto->precio,
                'subtotal'        => $producto->precio * $request->cantidad,
            ]);
        }

        $this->recalcularTotal($carrito);
        return back()->with('success', 'Producto agregado al carrito');
    }

    // 5.4 — eliminar() — quitar producto
    public function eliminar($id)
    {
        $carrito = $this->obtenerCarrito();
        $carrito->detalles()->where('id', $id)->delete();
        $this->recalcularTotal($carrito);
        return back()->with('success', 'Producto eliminado');
    }

    // 5.5 — confirmar() — cerrar la compra
    public function confirmar()
    {
        $carrito = $this->obtenerCarrito();
        
        if ($carrito->detalles()->count() === 0) {
            return back()->with('error', 'Tu carrito está vacío');
        }

        $items = $carrito->detalles()->with('producto')->get();
        $total = $carrito->total;

        // Cambia estado y guarda fecha exacta de la compra
        $carrito->update([
            'estado'      => 'confirmado',
            'fecha_venta' => now(),
        ]);

        // Pasa los datos por sesión a la vista de confirmación
        return redirect()->route('compra.confirmada')
                         ->with('items', $items)
                         ->with('total', $total);
    }

    // 5.6 — recalcularTotal() — helper privado
    private function recalcularTotal(VentaCabecera $carrito)
    {
        // sum() suma todos los subtotales de los ítems del carrito
        $total = $carrito->detalles()->sum('subtotal');
        $carrito->update(['total' => $total]);
    }

    // 💡 Solo te falta asegurar que exista este método aquí adentro:
    // private function obtenerCarrito() { ... }

    }

