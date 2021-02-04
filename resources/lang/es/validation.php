<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'El campo :attribute debe ser aceptado.',
    'active_url' => 'El campo :attribute no es una URL válida.',
    'after' => 'El campo :attribute debe ser una fecha posterior a :date.',
    'after_or_equal' => 'El campo :attribute debe ser una fecha posterior o igual a :date.',
    'alpha' => 'El campo :attribute solo puede contener letras.',
    'alpha_dash' => 'El campo :attribute solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El campo :attribute solo puede contener letras y números.',
    'array' => 'El campo :attribute debe ser un array.',
    'before' => 'El campo :attribute debe ser una fecha anterior a :date.',
    'before_or_equal' => 'El campo :attribute debe ser una fecha anterior o igual a :date.',
    'between' => [
        'numeric' => 'El campo :attribute debe estar entre :min y :max.',
        'file' => 'El archivo :attribute debe estar entre :min y :max kilobytes.',
        'string' => 'El campo :attribute debe estar entre :min y :max caracteres.',
        'array' => 'El campo :attribute debe tener entre :min y :max elementos.',
    ],
    'boolean' => 'El campo :attribute debe ser Verdadero o Falso.',
    'confirmed' => 'El campo :attribute de confirmación no coincide.',
    'date' => 'El campo :attribute no es una fecha válida.',
    'date_equals' => 'El campo :attribute debe ser una fecha igual a :date.',
    'date_format' => 'El campo :attribute no coincide con el formato :format.',
    'different' => 'Los campos :attribute y :other deben ser diferentes.',
    'digits' => 'El campo :attribute debe tener :digits digitos.',
    'digits_between' => 'El campo :attribute debe tener entre :min y :max digitos.',
    'dimensions' => 'El archivo :attribute tiene dimensiones de imagen inválidas.',
    'distinct' => 'El campo :attribute tiene un valor duplicado.',
    'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
    'ends_with' => 'El campo :attribute debe terminar con uno de los siguientes: :values valores.',
    'exists' => 'El campo selecionado :attribute es inválido.',
    'file' => 'El campo :attribute debe ser un archivo.',
    'filled' => 'El campo :attribute debe tener un valor.',
    'gt' => [
        'numeric' => 'El campo :attribute debe ser mayor que :value.',
        'file' => 'El archivo :attribute debe ser mayor que :value kilobytes.',
        'string' => 'El campo :attribute debe ser mayor que :value caracteres.',
        'array' => 'El campo :attribute debe tener más de :value elementos.',
    ],
    'gte' => [
        'numeric' => 'El campo :attribute debe ser mayor o igual a :value.',
        'file' => 'El archivo :attribute debe sser mayor o igual a :value kilobytes.',
        'string' => 'El campo :attribute debe ser mayor o igual a :value caracteres.',
        'array' => 'El campo :attribute debe tener :value elementos o más.',
    ],
    'image' => 'El archivo :attribute debe ser una imagen.',
    'in' => 'El elemento :attribute seleccionado es inválido.',
    'in_array' => 'El campo :attribute no existe en :other.',
    'integer' => 'El campo :attribute debe ser un número entero.',
    'ip' => 'El campo :attribute debe ser una dirección IP válida.',
    'ipv4' => 'El campo :attribute debe ser una dirección IPv4 válida.',
    'ipv6' => 'El campo :attribute debe ser una dirección IPv6 válida.',
    'json' => 'El campo :attribute debe ser una cadena JSON válida.',
    'lt' => [
        'numeric' => 'El campo :attribute debe ser menor que :value.',
        'file' => 'El archivo :attribute debe ser menor que :value kilobytes.',
        'string' => 'El campo :attribute debe ser menor que :value caracteres.',
        'array' => 'El campo :attribute debe tener menos de :value elementos.',
    ],
    'lte' => [
        'numeric' => 'El campo :attribute debe ser menor o igual a :value.',
        'file' => 'El archivo :attribute debe ser menor o igual a :value kilobytes.',
        'string' => 'El campo :attribute debe ser menor o igual a :value caracteres.',
        'array' => 'El campo :attribute debe tener mas de :value elementos.',
    ],
    'max' => [
        'numeric' => 'El campo :attribute no puede ser mayor que :max.',
        'file' => 'El archivo :attribute no puede ser mayor que :max kilobytes.',
        'string' => 'El campo :attribute no puede ser mayor que :max caracteres.',
        'array' => 'El campo :attribute no puede tener más de :max elementos.',
    ],
    'mimes' => 'El campo :attribute debe ser un archivo del tipo: :values.',
    'mimetypes' => 'El campo :attribute debe ser un archivo del tipo: :values.',
    'min' => [
        'numeric' => 'El campo :attribute debe ser almentos :min.',
        'file' => 'El archivo :attribute debe tener almenos :min kilobytes.',
        'string' => 'El campo :attribute debe tener almenos :min caracteres.',
        'array' => 'El campo :attribute debe tener almenos :min elementos.',
    ],
    'multiple_of' => 'El campo :attribute debe ser un multiplo de :value',
    'not_in' => 'El campo :attribute seleccionado es inválido.',
    'not_regex' => 'El formato del campo :attribute es inválido.',
    'numeric' => 'El campo :attribute debe ser un número.',
    'password' => 'La contraseña es incorrecta.',
    'present' => 'El campo :attribute debe estar presente.',
    'regex' => 'El formato del campo :attribute es inválido.',
    'required' => 'El campo :attribute es requerido.',
    'required_if' => 'El campo :attribute es requerido cuando el campo :other es :value.',
    'required_unless' => 'El campo :attribute es requerido a menos que :other se encuentre en :values.',
    'required_with' => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all' => 'El campo :attribute es obligatorio cuando :values están presentes.',
    'required_without' => 'El campo :attribute es obligatorio cuando :values no están presentes.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de los campos :values están presentes.',
    'same' => 'Los campos :attribute y :other deben coincidir.',
    'size' => [
        'numeric' => 'El campo :attribute debe ser :size.',
        'file' => 'El archivo :attribute debe pesar :size kilobytes.',
        'string' => 'El campo :attribute debe contener :size caracteres.',
        'array' => 'El campo :attribute debe contener :size elementos.',
    ],
    'starts_with' => 'El campo :attribute debe comenzar con uno de los siguientes valores: :values.',
    'string' => 'El campo :attribute debe ser una cadena de caracteres.',
    'timezone' => 'El campo :attribute debe ser una zona horaria válida.',
    'unique' => 'El valor del campo :attribute ya está en uso.',
    'uploaded' => 'El campo :attribute no se pudo subir.',
    'url' => 'El formato del campo :attribute es inválido.',
    'uuid' => 'El campo :attribute debe ser un UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
