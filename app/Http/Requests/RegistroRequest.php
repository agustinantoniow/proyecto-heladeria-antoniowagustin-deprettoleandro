<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
{
    // CAMBIAR A TRUE para que Laravel te deje procesar el formulario
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'Nombre_registro'  => 'required|min:4|max:20',
            'Apellido_registro' => 'required|min:4|max:20',
            'email_registro' => 'required|email|min:6',
            'password_registro' => 'required|min:6|confirmed', // busca campo password_confirmation
            'ciudad' => 'required|min:2|max:50',
            'codigo_postal' => 'required|digits:4',
        ];
    }

    public function messages()
    {
        return [
            'Nombre_registro.required'  => 'Tenés que poner tu nombre.',
            'Nombre_registro.min'       => 'El nombre debe tener al menos 4 letras.',
            'Nombre_registro.max'       => 'El nombre no debe tener más de 20 letras.',
            'Apellido_registro.required' => 'Tenés que poner tu apellido.',
            'Apellido_registro.min' => 'El apellido debe tener al menos 4 letras.',
            'Apellido_registro.max' => 'El apellido no debe tener más de 20 letras.',
            'email_registro.required' => 'El correo electrónico es obligatorio.',
            'email_registro.email'    => 'El correo electrónico no es válido.',
            'email_registro.min'      => 'El correo electrónico debe tener al menos 6 caracteres.',
            'password_registro.required' => 'La contraseña es obligatoria.',
            'password_registro.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password_registro.confirmed' => 'Las contraseñas no coinciden.',
            'ciudad.required' => 'La ciudad es obligatoria.',
            'ciudad.min' => 'La ciudad debe tener al menos 2 caracteres.',
            'ciudad.max' => 'La ciudad no debe tener más de 50 caracteres.',
            'codigo_postal.required' => 'El código postal es obligatorio.',
            'codigo_postal.digits' => 'El código postal debe tener exactamente 4 dígitos.',
        ];
    }
}