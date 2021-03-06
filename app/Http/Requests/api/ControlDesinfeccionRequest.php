<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;

class ControlDesinfeccionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'CTD_Automovil_Id' => 'required|integer',
            'CTD_Usuario_Id' => 'required|integer',
            'CTD_Temperatura_Control_Desinfeccion' => 'required|numeric',
            'CTD_Firma_Control_Desinfeccion' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'CTD_Automovil_Id.required' => 'El automovil es requerido.',
            'CTD_Automovil_Id.integer' => 'El automovil debe ser un número entero.',
            'CTD_Usuario_Id.required' => 'El usuario es requerido.',
            'CTD_Usuario_Id.integer' => 'El usuario debe ser un número entero.',
            'CTD_Temperatura_Control_Desinfeccion.required' => 'La temperatura es requerida.',
            'CTD_Temperatura_Control_Desinfeccion.numeric' => 'La temperatura debe ser de tipo decimal.',
            'CTD_Firma_Control_Desinfeccion.required'  => 'La firma es requerido.',
        ];
    }
}
