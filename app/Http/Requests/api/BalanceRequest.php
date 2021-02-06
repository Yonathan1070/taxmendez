<?php

namespace App\Http\Requests\api;

use App\Models\Entity\Usuarios;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class BalanceRequest extends FormRequest
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
    public function rules($idUsuario)
    {
        return [
            'Fecha' => 'required|max:10|date|before:'.Carbon::now()->format('Y-m-d'),
            'Kilometraje_Total' => 'required|max:10|regex:/^[0-9]+$/u',
            'Kilometraje_Turno' => 'required|max:4|regex:/^[0-9]+$/u',
            'Producido' => 'required|max:6|regex:/^[0-9]+$/u',
            'Conductor' => 'required|regex:/^[0-9]+$/u|exists:TBL_Usuario,id',
            'Turno' => 'required|regex:/^[0-9]+$/u|exists:TBL_Turno,id',
            'Observaciones' => 'regex:/^[a-zA-Z0-9 ]+$/u',
        ];
    }

    public function messages()
    {
        return [
            'Fecha.required' => 'La fecha es requerida.',
            'Fecha.max' => 'La fecha excede el limite de :max carácteres.',
            'Fecha.date' => 'Digite una fecha válida.',
            'Fecha.before' => 'La fecha no debe ser superior a la fecha actual.',
            'Kilometraje_Total.required' => 'El kilometraje total es requerido.',
            'Kilometraje_Total.max' => 'El kilometraje total excede el limite de :max caracteres.',
            'Kilometraje_Total.regex' => 'El kilometraje no debe contener letras ni caracteres especiales',
            'Kilometraje_Turno.required' => 'Los kilometros andados es requerido.',
            'Kilometraje_Turno.max' => 'El campo de los kilometros andados excede el limite de :max caracteres.',
            'Kilometraje_Turno.regex' => 'Los kilometros andados no debe contener letras ni caracteres especiales.',
            'Producido.required'  => 'El producido es requerido.',
            'Producido.max'  => 'El producido excede el limite de :max carácteres.',
            'Producido.regex' => 'El producido no debe contener letras ni caracteres especiales.',
            'Conductor.required' => 'El conductor es requerido.',
            'Conductor.regex' => 'El conductor no puede contener letras ni caractreres especiales.',
            'Conductor.exists' => 'El conductor no existe.',
            'Turno.required' => 'El turno es requerido.',
            'Turno.regex' => 'El tuno no puede contener letras ni caracteres especiales.',
            'Turno.exists' => 'El turno no existe.',
            'Observaciones.regex' => 'Las observaciones no puede contener caracteres especiales',
            
        ];
    }
}
