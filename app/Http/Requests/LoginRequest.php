<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    // CAMBIAR A TRUE para que Laravel te deje procesar el formulario
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'usuario'  => 'required|min:4|max:20',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'usuario.required'  => 'Tenés que poner tu nombre de usuario.',
            'usuario.min'       => 'El usuario debe tener al menos 4 letras.',
            'usuario.max'       => 'eyy crack El usuario no debe tener más de 20 letras.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min'      => 'La clave debe tener al menos 6 caracteres.',
        ];
    }
}