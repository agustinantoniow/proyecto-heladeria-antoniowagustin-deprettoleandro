<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\VentaDetalle;

use App\Models\Producto;
use App\Models\VentaCabecera;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller

{

    public function index()
    {
        // Traemos las Cabeceras (pedidos enteros) usando el Modelo, NO usamos DB::table
        $ventas = \App\Models\VentaCabecera::with('user')
            ->where('estado', 'completado')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalVentas = $ventas->count();

        return view('backend.admin.ventas', compact('ventas', 'totalVentas'));
    }

    public function verDetalleAdmin($id)
    {
        // Buscamos la cabecera SIN el filtro de auth()->id(), porque el admin puede ver todo
        $venta = \App\Models\VentaCabecera::with(['detalles.producto.categoria', 'user'])->findOrFail($id);

        // 🌟 ACÁ ESTÁ EL CAMBIO: Le ponemos ventaDetalle respetando tu mayúscula
        return view('backend.admin.ventaDetalle', compact('venta'));
    }

    public function procesar(Request $request)
{
    // 1. PRIMERO: Validamos que el DNI y Teléfono sean solo números
    $request->validate([
        'dni' => 'required|numeric',
        'telefono' => 'required|numeric',
    ], [
        'dni.required' => 'El DNI es obligatorio.',
        'dni.numeric' => 'El DNI solo puede contener números.',
        'telefono.required' => 'El teléfono es obligatorio.',
        'telefono.numeric' => 'El teléfono solo puede contener números.',
    ]);

    // 2. DESPUÉS: Acá sigue el código que ya tenían armado 
    // para guardar la VentaCabecera, el VentaDetalle, etc...
    
    // ...
}

    public function misCompras()

{

    // Buscamos directamente en la base de datos cruzando las tablas

    $compras = DB::table('venta_detalles')

        ->join('venta_cabeceras', 'venta_detalles.venta_cabecera_id', '=', 'venta_cabeceras.id')

        ->join('productos', 'venta_detalles.producto_id', '=', 'productos.id')

        ->leftJoin('categorias', 'productos.categoria_id', '=', 'categorias.id')

        ->where('venta_cabeceras.user_id', '=', auth()->id()) // Filtra por el cliente logueado

        ->where('venta_cabeceras.estado', '=', 'completado')  // Filtra que la compra esté completada

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



    // Retorna tu vista pasándole la variable corregida

    return view('frontend.compras', compact('compras'));

}

public function store(Request $request)

{

    // 1. Validaciones adaptadas exactamente a la lógica de tu formulario

   $request->validate([
        // Usamos digits_between que es perfecto para DNIs y Teléfonos
        'dni'          => 'required|regex:/^[0-9]+$/|digits_between:7,9',
        'telefono'     => 'required|regex:/^[0-9]+$/|digits_between:6,15',
        
        'tipo_entrega' => 'required|in:local,domicilio',
        
        'direccion'    => [
            'required_if:tipo_entrega,domicilio',
            'nullable',
            'string',
            'max:255',
            'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s\.,\-#º°]+$/'
        ],
        
        'medio_pago'   => 'required_if:tipo_entrega,domicilio|nullable|not_in:0',
    ], [
        // Mensajes para el DNI
        'dni.required'          => 'El DNI es obligatorio.',
        'dni.regex'             => 'El DNI solo puede contener números, sin espacios ni puntos.',
        'dni.digits_between'    => 'El DNI debe tener entre 7 y 9 números.',

        // Mensajes para el Teléfono
        'telefono.required'     => 'El teléfono es obligatorio.',
        'telefono.regex'        => 'El teléfono solo puede contener números, sin espacios ni guiones.',
        'telefono.digits_between' => 'El teléfono debe tener entre 6 y 15 números.',

        // Mensajes para Envío y Pago
        'tipo_entrega.required' => 'Debés seleccionar una forma de entrega.',
        
        'direccion.required_if' => 'La dirección es obligatoria cuando elegís envío a domicilio.',
        'direccion.regex'       => 'La dirección contiene símbolos no permitidos.',
        
        'medio_pago.required_if'=> 'Debés seleccionar un medio de pago para el envío a domicilio.',
        'medio_pago.not_in'     => 'Seleccioná un medio de pago válido.',
    ]);

    // 2. Obtener el carrito de la sesión

    $carrito = session()->get('carrito', []);

   

    if (empty($carrito)) {

        return redirect()->back()->with('error', 'El carrito está vacío o tu sesión ha expirado.');

    }



    // Calcular el total de la compra

    $totalVenta = 0;

    foreach ($carrito as $item) {

        $totalVenta += $item['precio'] * $item['cantidad'];

    }



    // 3. Transacción segura en la Base de Datos

    DB::beginTransaction();



    try {

        // 4. Insertar la Cabecera de la Venta

        $cabecera = new VentaCabecera();

        $cabecera->user_id = auth()->id(); // Se asocia al usuario logueado

        $cabecera->estado = 'pendiente';   // Estado inicial

        $cabecera->total = $totalVenta;

       

        // ASIGNACIÓN DE LOS DATOS DEL FORMULARIO (Descomentados y vinculados)

        $cabecera->dni = $request->dni;

        $cabecera->telefono = $request->telefono;

        $cabecera->tipo_entrega = $request->tipo_entrega;

        $cabecera->direccion = $request->direccion;

        $cabecera->medio_pago = $request->medio_pago; // Guardamos también el medio de pago



        $cabecera->save();



        // 5. Insertar los Detalles recorriendo el carrito

        foreach ($carrito as $id => $item) {

            $detalle = new VentaDetalle();

            $detalle->venta_cabecera_id = $cabecera->id;

           

            // Evaluamos de dónde viene el ID del producto

            $productoId = $item['producto_id'] ?? $id;



            $detalle->producto_id = $productoId;

            $detalle->cantidad = $item['cantidad'];

            $detalle->precio_unitario = $item['precio'];

            $detalle->subtotal = $item['precio'] * $item['cantidad'];

            $detalle->save();



            // 6. Restar el stock del Producto comprado

            $producto = Producto::find($productoId);

            if ($producto) {

                // Validación de seguridad por si se quedan sin stock en medio de la operación

                if ($producto->stock < $item['cantidad']) {

                    throw new \Exception("Lo sentimos, no hay suficiente stock para el producto: {$producto->nombre}");

                }

                $producto->stock -= $item['cantidad'];

                $producto->save();

            }

        }



        // Si todo en el bloque try fue exitoso, guardamos cambios reales en DB

        DB::commit();



        // Limpiamos el carrito de la sesión

        session()->forget('carrito');



        // Redirecciona a la vista de Comprobante / Éxito

        return redirect()->route('carrito.comprobante', ['id_venta' => $cabecera->id])

                         ->with('success', '¡Compra finalizada con éxito!');



    } catch (\Exception $e) {

        // Si algo falló, se cancela todo el guardado y el carrito NO se borra de la sesión

        DB::rollBack();

        return redirect()->back()->withInput()->with('error', 'Error al procesar la compra: ' . $e->getMessage());

    }

} // Cierra la función store


    // =========================================================
    // MUESTRA EL COMPROBANTE DE LA COMPRA FINALIZADA
    // =========================================================
    public function comprobante($id_venta)
    {
        
        // 1. Buscamos la cabecera de la venta asegurándonos de que pertenezca al usuario logueado
        $venta = DB::table('venta_cabeceras')
                    ->where('id', $id_venta)
                    ->where('user_id', auth()->id())
                    ->first();

        // Si la venta no existe o no es de este usuario, lo mandamos al inicio por seguridad
        if (!$venta) {
            return redirect()->route('cliente.home')->with('error', 'El comprobante solicitado no existe.');
        }

        // 2. Buscamos los detalles de esa venta uniéndolos con la tabla de productos para tener los nombres
        $detalles = DB::table('venta_detalles')
                    ->join('productos', 'venta_detalles.producto_id', '=', 'productos.id')
                    ->where('venta_detalles.venta_cabecera_id', $id_venta)
                    ->select('venta_detalles.*', 'productos.nombre as producto_nombre')
                    ->get();

        // 3. Retornamos tu vista pasándole los datos de la venta y sus productos
        return view('frontend.comprobante', compact('venta', 'detalles'));
    }

} // <--- ESTA ÚLTIMA LLAVE CIERRA LA CLASE VentaController