<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'motivo' => 'required|string|max:200',
            'consulta' => 'required|string|min:10|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Formato de email inválido.',
            'consulta.min' => 'Debe tener al menos 10 caracteres.',
        ];
    }
}