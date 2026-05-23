<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ConsultaRequest extends FormRequest
{
    // CAMBIAR A TRUE para que Laravel te deje procesar el formulario
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'NombreConsulta'  => 'required|min:4|max:20',
            'emailConsulta' => 'required|email|min:6',
            'Numero_Telefono' => 'required|digits:10',
            'Mensaje'   => 'required|min:10|max:500',   
        ];
    }

    public function messages()
    {
        return [
            'NombreConsulta.required'  => 'Tenés que poner tu nombre.',
            'NombreConsulta.min'       => 'El nombre debe tener al menos 4 letras.',
            'NombreConsulta.max'       => 'El nombre no debe tener más de 20 letras.',
            'emailConsulta.required' => 'El correo electrónico es obligatorio.',
            'emailConsulta.email'    => 'El correo electrónico no es válido.',
            'emailConsulta.min'      => 'El correo electrónico debe tener al menos 6 caracteres.',
            'Numero_Telefono.required' => 'El número de teléfono es obligatorio.',
            'Numero_Telefono.digits' => 'El número de teléfono debe tener exactamente 10 dígitos.',
            'Mensaje.required' => 'El mensaje es obligatorio.',
            'Mensaje.min' => 'El mensaje debe tener al menos 10 caracteres.',
            'Mensaje.max' => 'El mensaje no debe tener más de 500 caracteres.',
        ];
    }
}