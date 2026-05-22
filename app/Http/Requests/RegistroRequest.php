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
            'Nombre'  => 'required|min:4|max:20',
            'Apellido' => 'required|min:4|max:20',
            'email' => 'required|email|min:6',
            'password' => 'required|min:6|confirmed', // busca campo password_confirmation
            'ciudad' => 'required|min:2|max:50',
            'codigo_postal' => 'required|digits:4',
        ];
    }

    public function messages()
    {
        return [
            'Nombre.required'  => 'Tenés que poner tu nombre.',
            'Nombre.min'       => 'El nombre debe tener al menos 4 letras.',
            'Nombre.max'       => 'El nombre no debe tener más de 20 letras.',
            'Apellido.required' => 'Tenés que poner tu apellido.',
            'Apellido.min' => 'El apellido debe tener al menos 4 letras.',
            'Apellido.max' => 'El apellido no debe tener más de 20 letras.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email'    => 'El correo electrónico no es válido.',
            'email.min'      => 'El correo electrónico debe tener al menos 6 caracteres.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'ciudad.required' => 'La ciudad es obligatoria.',
            'ciudad.min' => 'La ciudad debe tener al menos 2 caracteres.',
            'ciudad.max' => 'La ciudad no debe tener más de 50 caracteres.',
            'codigo_postal.required' => 'El código postal es obligatorio.',
            'codigo_postal.digits' => 'El código postal debe tener exactamente 4 dígitos.',
        ];
    }
}