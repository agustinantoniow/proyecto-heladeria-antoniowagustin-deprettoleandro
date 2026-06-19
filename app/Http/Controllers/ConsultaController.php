<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Agregamos este import para no poner \DB siempre
use App\Models\Consulta; // Importamos el modelo Consulta para usarlo en el método destroy

class ConsultaController extends Controller
{
    // Muestra la lista de consultas al admin
    public function index()
    {
      $consultas = Consulta::all();
        return view('admin.consultas', compact('consultas'));
    }


    // Procesa el envío del formulario
 public function store(Request $request)
{
    $rules = [
        // Añadida la regla regex para evitar números en el nombre
        'nombreConsulta' => 'required|string|min:3|max:150|regex:/^[\pL-]+$/u', 
        'emailConsulta'   => 'required|email|email:rfc,dns',
        'numero_telefono' => 'required|numeric|digits_between:8,15', 
        'opcion_consulta' => 'required',
        'mensaje'         => 'required|string|min:5|max:255',
    ];

    $messages = [
        // Las llaves ahora coinciden exactamente con los nombres de los inputs del formulario
        'nombreConsulta.required' => 'Por favor, ingresá tu nombre.',
        'nombreConsulta.min'      => 'El nombre debe tener al menos 3 caracteres.',
        'nombreConsulta.max'      => 'El nombre no puede tener más de 150 caracteres.',
        'nombreConsulta.regex'    => 'El nombre no puede contener números ni caracteres especiales.',

        'emailConsulta.required'  => 'El correo electrónico es obligatorio.',
        'emailConsulta.email'     => 'Ingresá un correo válido (ejemplo@gmail.com).',
        
        'numero_telefono.required' => 'El número de teléfono es obligatorio.',
        'numero_telefono.min'      => 'El número de teléfono debe tener al menos 8 dígitos.',
        'numero_telefono.max'      => 'El número de teléfono no puede tener más de 15 dígitos.',
        'numero_telefono.numeric'        => 'El teléfono solo debe contener números, sin letras, espacios ni guiones.',
        
        'opcion_consulta.required' => 'Debes seleccionar un motivo para tu consulta.',
        
        'mensaje.required' => 'El mensaje no puede quedar vacío.',
        'mensaje.min'      => 'Por favor, detalla un poco más tu consulta (mínimo 5 caracteres).',
        'mensaje.max'      => 'El mensaje es demasiado largo (máximo 255 caracteres).',
    ];

    $request->validate($rules, $messages);
           
    DB::table('consultas')->insert([
        'nombre'          => $request->nombreConsulta,
        'email'           => $request->emailConsulta,
        'numero_telefono' => $request->numero_telefono,
        'tipo'            => $request->opcion_consulta, 
        'mensaje'         => $request->mensaje,
        'created_at'      => now(),
        'updated_at'      => now(),
    ]);

    return redirect('/exito');
}
    public function marcarLeido($id)
{
    $consulta = Consulta::findOrFail($id);
    $consulta->leido = true;
    $consulta->save();

    return back()->with('success', 'Consulta marcada como leída.');
}
public function destroy($id)
{
    // Buscamos la consulta usando el modelo Consulta
    $consulta = Consulta::findOrFail($id);
    $consulta->delete();
    
    // Al tener el SoftDeletes en el modelo, esto ya NO va a borrar la fila,
    // solo va a llenar el campo 'deleted_at' con la fecha actual.
  

   return redirect()->back();
}
}