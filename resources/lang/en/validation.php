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

    'accepted'             => 'The :ATTRIBUTE must be accepted.',
    'active_url'           => 'The :ATTRIBUTE is not a valid URL.',
    'after'                => 'The :ATTRIBUTE must be a date after :date.',
    'after_or_equal'       => 'The :ATTRIBUTE must be a date after or equal to :date.',
    'alpha'                => 'The :ATTRIBUTE may only contain letters.',
    'alpha_dash'           => 'The :ATTRIBUTE may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :ATTRIBUTE may only contain letters and numbers.',
    'array'                => 'The :ATTRIBUTE must be an array.',
    'before'               => 'The :ATTRIBUTE must be a date before :date.',
    'before_or_equal'      => 'The :ATTRIBUTE must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :ATTRIBUTE must be between :min and :max.',
        'file'    => 'The :ATTRIBUTE must be between :min and :max kilobytes.',
        'string'  => 'The :ATTRIBUTE must be between :min and :max characters.',
        'array'   => 'The :ATTRIBUTE must have between :min and :max items.',
    ],
    'boolean'              => 'The :ATTRIBUTE field must be true or false.',
    'confirmed'            => 'The :ATTRIBUTE confirmation does not match.',
    'date'                 => 'The :ATTRIBUTE is not a valid date.',
    'date_format'          => 'The :ATTRIBUTE does not match the format :format.',
    'different'            => 'The :ATTRIBUTE and :other must be different.',
    'digits'               => 'The :ATTRIBUTE must be :digits digits.',
    'digits_between'       => 'The :ATTRIBUTE must be between :min and :max digits.',
    'dimensions'           => 'The :ATTRIBUTE has invalid image dimensions.',
    'distinct'             => 'The :ATTRIBUTE field has a duplicate value.',
    'email'                => 'The :ATTRIBUTE must be a valid email address.',
    'exists'               => 'The selected :ATTRIBUTE is invalid.',
    'file'                 => 'The :ATTRIBUTE must be a file.',
    'filled'               => 'The :ATTRIBUTE field must have a value.',
    'image'                => 'The :ATTRIBUTE must be an image.',
    'in'                   => 'The ATTRIBUTE :attribute is invalid.',
    'in_array'             => 'The :ATTRIBUTE field does not exist in :other.',
    'integer'              => 'The :ATTRIBUTE must be an integer.',
    'ip'                   => 'The :ATTRIBUTE must be a valid IP address.',
    'ipv4'                 => 'The :ATTRIBUTE must be a valid IPv4 address.',
    'ipv6'                 => 'The :ATTRIBUTE must be a valid IPv6 address.',
    'json'                 => 'The :ATTRIBUTE must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :ATTRIBUTE may not be greater than :max.',
        'file'    => 'The :ATTRIBUTE may not be greater than :max kilobytes.',
        'string'  => 'The :ATTRIBUTE may not be greater than :max characters.',
        'array'   => 'The :ATTRIBUTE may not have more than :max items.',
    ],
    'mimes'                => 'The :ATTRIBUTE must be a file of type: :values.',
    'mimetypes'            => 'The :ATTRIBUTE must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :ATTRIBUTE must be at least :min.',
        'file'    => 'The :ATTRIBUTE must be at least :min kilobytes.',
        'string'  => 'The :ATTRIBUTE must be at least :min characters.',
        'array'   => 'The :ATTRIBUTE must have at least :min items.',
    ],
    'not_in'               => 'The selected :ATTRIBUTE is invalid.',
    'numeric'              => 'The :ATTRIBUTE must be a number.',
    'present'              => 'The :ATTRIBUTE field must be present.',
    'regex'                => 'The :ATTRIBUTE format is invalid.',
    'required'             => 'The :ATTRIBUTE field is required.',
    'required_if'          => 'The :ATTRIBUTE field is required when :other is :value.',
    'required_unless'      => 'The :ATTRIBUTE field is required unless :other is in :values.',
    'required_with'        => 'The :ATTRIBUTE field is required when :values is present.',
    'required_with_all'    => 'The :ATTRIBUTE field is required when :values is present.',
    'required_without'     => 'The :ATTRIBUTE field is required when :values is not present.',
    'required_without_all' => 'The :ATTRIBUTE field is required when none of :values are present.',
    'same'                 => 'The :ATTRIBUTE and :other must match.',
    'size'                 => [
        'numeric' => 'The :ATTRIBUTE must be :size.',
        'file'    => 'The :ATTRIBUTE must be :size kilobytes.',
        'string'  => 'The :ATTRIBUTE must be :size characters.',
        'array'   => 'The :ATTRIBUTE must contain :size items.',
    ],
    'string'               => 'The :ATTRIBUTE must be a string.',
    'timezone'             => 'The :ATTRIBUTE must be a valid zone.',
    'unique'               => 'The :ATTRIBUTE has already been taken.',
    'uploaded'             => 'The :ATTRIBUTE failed to upload.',
    'url'                  => 'The :ATTRIBUTE format is invalid.',
    'vsa_less_than_vsd' => 'The :ATTRIBUTE must be greater than :FIELD',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
