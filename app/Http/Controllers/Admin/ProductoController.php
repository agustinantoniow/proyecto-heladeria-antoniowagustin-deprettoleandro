<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use App\Models\Producto;

use App\Models\Categoria;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;



class ProductoController extends Controller

{

    // 1. Muestra la tabla principal con todos los productos

    public function index()

    {

        $productos = Producto::with('categoria')->get();

        $categorias = Categoria::all();

       

        return view('backend.admin.productos.index', compact('productos', 'categorias'));

    }



    // 2. Muestra la vista con el formulario para agregar un producto

    public function create()

    {

        $categorias = Categoria::all();

        return view('backend.admin.productos.create', compact('categorias'));

    }



    // 3. Recibe los datos del formulario y los guarda en la base de datos

    public function store(Request $request)

    {

        $request->validate([

            'nombre'       => 'required|string|min:5|max:100|regex:/^[\pL\s\-]+$/u',

            'categoria_id' => 'required|exists:categorias,id',

            'precio'       => 'required|numeric|min:100',

            'stock'        => 'required|integer|min:1',

            'descripcion'  => 'nullable|string|max:500|min:5',

            'imagen'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',

            // 2MB máx

            ]);

       

        $nombreImagen = null;

        if ($request->hasFile('imagen')) {

            $imagen = $request->file('imagen');

            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();

            $imagen->move(public_path('uploads/productos'), $nombreImagen);

        }



        Producto::create([

            'nombre'       => $request->nombre,

            'categoria_id' => $request->categoria_id,

            'descripcion'  => $request->descripcion,

            'precio'       => $request->precio,

            'stock'        => $request->stock,

            'imagen'       => $nombreImagen,

            'activo'       => true

        ]);



        return redirect()->route('admin.productos.index')->with('success', '¡Producto agregado con éxito!');

    }

    public function update(Request $request, $id)

{

    // 1. Validar datos

    $rules = [

        'nombre' => 'required|string|min:5|max:255|regex:/^[\pL\s\-]+$/u',

        'precio' => 'required|numeric',

        'categoria_id' => 'required|exists:categorias,id', // Validamos que la categoría exista

        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB máx

        'descripcion'  => 'nullable|string|max:500|min:5',

        'stock_inicial'=> 'required|integer|min:1'

    ];

    $messages = [
        'nombre.required' => 'El nombre del producto es obligatorio(ej: Americana).',

        'nombre.string'   => 'El nombre del producto debe ser un texto válido.',

        'nombre.min'      => 'El nombre del producto debe tener al menos 5 caracteres.',

        'nombre.max'      => 'El nombre del producto no puede tener más de 100 caracteres.',

        'nombre.regex'    => 'El nombre del gusto solo puede contener letras y espacios (sin números ni símbolos).',

        'nombre_gusto.min'      => 'El nombre del gusto debe tener al menos 3 letras.',

        'nombre_gusto.unique'   => 'Este gusto de helado ya se encuentra registrado.',

        'nombre_gusto.max'      => 'El nombre del gusto no puede tener más de, 255 caracteres.',

        
    

        'categoria_id.required' => 'Seleccioná una categoría para el producto.',

        'categoria_id.exists'   => 'La categoría seleccionada no es válida.',

       

        'precio.required'       => 'El precio es obligatorio.',

        'precio.numeric'        => 'El precio debe ser un número válido.',

        'precio.min'            => 'El precio no puede ser menor a 100.',

       

        'stock_inicial.required' => 'El stock inicial es obligatorio.',

        'stock_inicial.integer'  => 'El stock debe ser un número entero.',

        'stock_inicial.min'      => 'El stock inicial no puede ser menor a 1 unidad.',

       

         'descripcion.string'    => 'La descripción debe ser un texto válido.',    

        'descripcion.max'       => 'La descripción es demasiado larga (máximo 500 caracteres).',

        'descripcion.min'       => 'La descripción es demasiado corta (mínimo 5 caracteres).',

        'imagen_gusto.image'    => 'El archivo seleccionado debe ser una imagen real.',

        'imagen_gusto.mimes'    => 'La foto debe estar en formato: jpeg, png, jpg o webp.',

        'imagen_gusto.max'      => 'La imagen es muy pesada. El tamaño máximo permitido es 5MB.',

    ];

    $request->validate($rules, $messages);

   

    // 2. Buscar registro

    $producto = Producto::findOrFail($id);



    // 3. Reemplazar textos Y la categoría

    $producto->nombre = $request->nombre;

    $producto->precio = $request->precio;

    $producto->categoria_id = $request->input('categoria_id'); // 🌟 Guardamos la categoría corregida

    $producto->imagen = $request->input('imagen'); //

    $producto->descripcion = $request->input('descripcion'); //





    // 4. Procesar imagen si el enctype del HTML está funcionando bien

    if ($request->hasFile('imagen')) {

       

        // Borrar imagen anterior si existe para no acumular archivos

        if ($producto->imagen && file_exists(public_path('uploads/productos/' . $producto->imagen))) {

            unlink(public_path('uploads/productos/' . $producto->imagen));

        }



        $file = $request->file('imagen');

        $filename = time() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('uploads/productos'), $filename);

       

        $producto->imagen = $filename; // Asignamos el nuevo nombre de archivo

    }



    // 5. Guardar todo junto en la BD

    $producto->save();



    return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');

}



    // 4. Alterna el estado de activo/inactivo (Pausar / Activar) del producto

    public function toggleStatus(Producto $producto)

    {

        $producto->update(['activo' => !$producto->activo]);



        return redirect()->route('admin.productos.index')->with('success', 'Estado del producto actualizado con éxito!');

    }



    // 5. Edición rápida por AJAX (Limpiado y sin duplicados)

    public function updateFast(Request $request, $id)

    {

        $producto = Producto::findOrFail($id);

       

        // Actualizamos los campos de texto

        $producto->nombre = $request->nombre;

        $producto->precio = $request->precio;

        $producto->stock = $request->stock;

         $producto->categoria_id = $request->categoria_id; // 🌟 Aseguramos que la categoría también se actualice en esta función rápida

       



        $imagenUrl = null;

       

        // Si el usuario subió una imagen nueva, la procesamos

        if ($request->hasFile('imagen')) {

           

            // Eliminamos la imagen anterior si existe físicamente

            if ($producto->imagen) {

                $rutaAnterior = public_path('uploads/productos/' . $producto->imagen);

                if (File::exists($rutaAnterior)) {

                    File::delete($rutaAnterior);

                }

            }



            // Guardamos la nueva imagen

            $file = $request->file('imagen');

            $nombreImagen = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads/productos'), $nombreImagen);

           

            $producto->imagen = $nombreImagen;

            $imagenUrl = asset('uploads/productos/' . $nombreImagen);

        }



        $producto->save();



        return response()->json([

            'success' => true,

            'message' => 'Producto actualizado correctamente.',

            'imagen_url' => asset('uploads/productos/' . $producto->imagen)

        ]);

    }



    // 6. Eliminar producto definitivamente

    public function destroy($id)

    {

        $producto = Producto::findOrFail($id);

       

        // Borramos la foto del servidor primero

        if ($producto->imagen) {

            $rutaImagen = public_path('uploads/productos/' . $producto->imagen);

            if (File::exists($rutaImagen)) {

                File::delete($rutaImagen);

            }

        }



        // FALTABA ESTO: Borrar el registro de la base de datos

        $producto->delete();



        return redirect()->route('admin.productos.index')->with('success', 'El producto ha sido eliminado permanentemente del catálogo.');

    }



    // 7. Catálogo para los clientes

   public function catalogoCliente()

    {

        // Traemos los helados activos

        $productos = Producto::where('activo', 1)->with('categoria')->get();

       

        // ¡NUEVO!: Traemos todas las categorías para armar los botones de filtro

        $categorias = Categoria::all();



        // Le pasamos ambas variables a la vista

        return view('frontend.catalogo', compact('productos', 'categorias'));

    }

   
}
    // (Nota: eliminé catalogoPublico() porque hacía exactamente lo mismo que catalogoCliente)