<?php

namespace App\Http\Requests\api;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class GastosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Fecha' => 'required|max:10|date|before:'.Carbon::now()->format('Y-m-d'),
            'Costo' => 'required|max:10|regex:/^[0-9]+$/u',
            'Descripcion' => 'required|regex:/^[a-zA-Z0-9 ]+$/u',
        ];
    }

    public function messages()
    {
        return [
            'Fecha.required' => 'La fecha es requerida.',
            'Fecha.max' => 'La fecha excede el limite de :max carácteres.',
            'Fecha.date' => 'Digite una fecha válida.',
            'Fecha.before' => 'La fecha no debe ser superior a la fecha actual.',
            'Costo.required'  => 'El costo es requerido.',
            'Costo.max'  => 'El costo excede el limite de :max carácteres.',
            'Costo.regex' => 'El costo no debe contener letras ni caracteres especiales.',
            'Descripcion.required' => 'La descripción es requerida',
            'Descripcion.regex' => 'La descripción no puede contener caracteres especiales',
            
        ];
    }
}
