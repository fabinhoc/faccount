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

    'accepted' => ':attribute deve ser aceito.',
    'accepted_if' => ':attribute deve ser aceito quando :other é :value.',
    'active_url' => ':attribute não é uma url válida.',
    'after' => ':attribute deve ser uma data maior que :date.',
    'after_or_equal' => ':attribute deve ser uma data maior ou igual a :date.',
    'alpha' => ':attribute deve conter apenas letras.',
    'alpha_dash' => ':attribute deve conter apenas letras, números, traços and sublinhados.',
    'alpha_num' => ':attribute deve conter apenas letras and números.',
    'array' => ':attribute deve ser um array.',
    'before' => ':attribute deve ser uma data menor que :date.',
    'before_or_equal' => ':attribute deve ser uma data menor ou igual a :date.',
    'between' => [
        'array' => ':attribute deve estar entre :min e :max items.',
        'file' => ':attribute deve estar entre :min e :max kilobytes.',
        'numeric' => ':attribute deve estar entre :min e :max.',
        'string' => ':attribute deve estar entre :min e :max caracteres.',
    ],
    'boolean' => ':attribute deve ser verdadeiro ou falso.',
    'confirmed' => ':attribute confirmação não corresponde.',
    'current_password' => 'Senha incorreta.',
    'date' => ':attribute não é uma data válida.',
    'date_equals' => ':attribute deve ser uma data igual a :date.',
    'date_format' => ':attribute não corresponde ao formato :format.',
    'declined' => ':attribute deve ser recusado.',
    'declined_if' => ':attribute deve ser recusado quando :other é :value.',
    'different' => ':attribute e :other deve ser diferente.',
    'digits' => ':attribute deve ser :digits digitos.',
    'digits_between' => ':attribute must be between :min and :max digits.',
    'dimensions' => ':attribute tem dimensões de imagem inválidas.',
    'distinct' => ':attribute campo tem um valor duplicado.',
    'email' => ':attribute deve ser um endereço de e-mail válido.',
    'ends_with' => ':attribute deve terminar com um dos seguintes: :values.',
    'enum' => 'Valor :attribute é inválido.',
    'exists' => 'Valor :attribute é inválido.',
    'file' => ':attribute deve ser um arquivo.',
    'filled' => 'Campo :attribute deve conter um valor.',
    'gt' => [
        'array' => ':attribute deve ter mais :value items.',
        'file' => ':attribute deve ser maior que :value kilobytes.',
        'numeric' => ':attribute deve ser maior que :value.',
        'string' => ':attribute deve ser maior que :value caracteres.',
    ],
    'gte' => [
        'array' => ':attribute deve conter :value items ou mais.',
        'file' => ':attribute deve ser maior ou igual a :value kilobytes.',
        'numeric' => ':attribute deve ser maior ou igual a :value.',
        'string' => ':attribute deve ser maior ou igual a :value caracteres.',
    ],
    'image' => ':attribute deve ser uma imagem.',
    'in' => 'Valor :attribute é inválido.',
    'in_array' => 'Valor :attribute não existe em :other.',
    'integer' => ':attribute deve ser um inteiro.',
    'ip' => ':attribute dever ser um endereço de IP válido.',
    'ipv4' => ':attribute dever ser um IPv4 válido.',
    'ipv6' => ':attribute dever ser um IPv6 válido.',
    'json' => ':attribute dever ser um JSON válido.',
    'lt' => [
        'array' => ':attribute deve ter menos que :value items.',
        'file' => ':attribute deve ser menor que :value kilobytes.',
        'numeric' => ':attribute deve ser menor que :value.',
        'string' => ':attribute deve ser menor que :value caracteres.',
    ],
    'lte' => [
        'array' => ':attribute não deve ter mais de :value items.',
        'file' => ':attribute deve ser menor que ou igual a :value kilobytes.',
        'numeric' => ':attribute deve ser menor ou igual to :value.',
        'string' => ':attribute deve ser menor ou igual :value caracteres.',
    ],
    'mac_address' => ':attribute deve ser um endereço MAC válido.',
    'max' => [
        'array' => ':attribute não deve ter mais de :max items.',
        'file' => ':attribute não deve ser maior que :max kilobytes.',
        'numeric' => ':attribute não deve ser maior que :max.',
        'string' => ':attribute não deve ser maior que :max caracteres.',
    ],
    'mimes' => ':attribute deve ser um arquivo do tipo: :values.',
    'mimetypes' => ':attribute deve ser um arquivo do tipo: :values.',
    'min' => [
        'array' => ':attribute deve ter pelo menos :min items.',
        'file' => ':attribute deve ser pelo menos :min kilobytes.',
        'numeric' => ':attribute deve ser pelo menos :min.',
        'string' => ':attribute deve ser pelo menos :min caracteres.',
    ],
    'multiple_of' => ':attribute deve ser um múltiplo de :value.',
    'not_in' => 'Valor :attribute é inválido.',
    'not_regex' => ':attribute formato é inválido.',
    'numeric' => ':attribute deve ser um número.',
    'password' => 'senha incorreta.',
    'present' => 'Campo :attribute deve estar presente.',
    'prohibited' => 'Campo :attribute é proibido.',
    'prohibited_if' => 'Campo :attribute é proibido quando :other é :value.',
    'prohibited_unless' => 'Campo :attribute é proibido a menos que :other está em :values.',
    'prohibits' => 'Campo :attribute proíbe :other de estar presente.',
    'regex' => ':attribute formato é inválido.',
    'required' => ':attribute field é obrigatório.',
    'required_array_keys' => 'Campo :attribute deve conter entradas para: :values.',
    'required_if' => 'Campo :attribute é obrigatório quando :other é :value.',
    'required_unless' => 'Campo :attribute é obrigatório a menos que :other esteja em :values.',
    'required_with' => 'Campo :attribute é obrigatório quando :values está presente.',
    'required_with_all' => 'Campo :attribute é obrigatório quando :values estão presentes.',
    'required_without' => 'Campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'Campo :attribute é obrigatório quando nenhum dos valores :values estão presentes.',
    'same' => ':attribute e :other deve combinar.',
    'size' => [
        'array' => ':attribute deve conter :size items.',
        'file' => ':attribute deve conter :size kilobytes.',
        'numeric' => ':attribute deve conter :size.',
        'string' => ':attribute deve ter :size caracteres.',
    ],
    'starts_with' => ':attribute deve começar com um dos seguintes valores: :values.',
    'string' => ':attribute deve ser uma string.',
    'timezone' => ':attribute deve ser um fuso horário válido.',
    'unique' => ':attribute já está em uso.',
    'uploaded' => ':attribute falha ao fazer upload.',
    'url' => ':attribute deve ser uma url válida.',
    'uuid' => ':attribute dever um UUID válido.',
    'cnpj' => ':attribute é inválido',
    'cpf' => ':attribute é inválido',

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
