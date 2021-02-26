<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'USR_Nombre_Usuario' => 'required|max:10|regex:/^[a-zA-Z0-9]+$/u',
            'password' => 'required|max:10|regex:/^[a-zA-Z0-9!#$%&¿¨´*+{}^`,;.:_-]+$/u',
        ];
    }

    public function messages()
    {
        return [
            'USR_Nombre_Usuario.required' => 'El nombre de usuario es requerido.',
            'USR_Nombre_Usuario.max' => 'El nombre de usuario excede el limite de :max caracteres.',
            'USR_Nombre_Usuario.regex' => 'El nombre de usuario no debe contener caracteres especiales',
            'password.required' => 'La contraseña es requerida.',
            'password.max' => 'La contraseña excede el limite de :max caracteres.',
            'password.regex' => 'La contraseña debe contener caracteres especiales (#*+.-_)',
        ];
    }
}
