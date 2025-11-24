<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'patente'     => 'required|string|max:10',
            'marca'       => 'required|string|max:50',
            'modelo'      => 'required|string|max:50',
            'color'       => 'required|string|max:50',
            'propietario' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'patente.required' => 'La patente es obligatoria.',
            'marca.required' => 'La marca es obligatoria.',
            'modelo.required' => 'El modelo es obligatorio.',
            'color.required' => 'El color es obligatorio.',
            'propietario.required' => 'El propietario es obligatorio.',
        ];
    }
}
