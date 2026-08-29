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

    'accepted' => 'Поле :attribute должно быть принято.',
    'accepted_if' => 'Поле :attribute должно быть принято когда :other является :value.',
    'active_url' => 'Поле :attribute должно быть действительным URL.',
    'after' => 'Поле :attribute должен быть датой после :date.',
    'after_or_equal' => 'Поле :attribute должен быть датой после или равен :date.',
    'alpha' => 'Поле :attribute может содержать только буквы.',
    'alpha_dash' => 'Поле :attribute может содержать только буквы, числа, дефисы и нижнее подчёркивание.',
    'alpha_num' => 'Поле :attribute может содержать только буквы и цифры.',
    'any_of' => 'Поле :attribute не действительно.',
    'array' => 'Поле :attribute может быть только массивом.',
    'ascii' => 'Поле :attribute может содержать только однобайтовые буквенно-цифровые символы и знаки.',
    'base64' => 'Поле :attribute должно быть корректной строкой Base64.',
    'before' => 'Поле :attribute должно быть датой раньше :date.',
    'before_or_equal' => 'Поле :attribute должно быть датой раньше или равной :date.',
    'between' => [
        'array' => 'Поле :attribute должно быть между :min и :max значениями.',
        'file' => 'Поле :attribute должно быть между :min и :max килобайтами.',
        'numeric' => 'Поле :attribute должно быть между :min и :max числовыми значением.',
        'string' => 'Поле :attribute должно быть между :min и :max символами.',
    ],
    'boolean' => 'Поле :attribute должно быть true или false (логическим значением).',
    'can' => 'Поле :attribute содержит недопустимое значение.',
    'confirmed' => 'Подтверждение поля :attribute не совпадает.',
    'contains' => 'В поле :attribute отсутствует требуемое значение.',
    'current_password' => 'Пароль не верный.',
    'date' => 'Поле :attribute должно быть корректной датой.',
    'date_equals' => 'Поле :attribute должно быть датой равной :date.',
    'date_format' => 'Поле :attribute должно совпадать с форматом :format.',
    'decimal' => 'Поле :attribute должно иметь :decimal десятичных знаков.',
    'declined' => 'Поле :attribute должно быть отклонено.',
    'declined_if' => 'Поле :attribute должно быть отклонено, когда :other равно :value.',
    'different' => 'Поля :attribute и :other должны отличаться.',
    'digits' => 'Поле :attribute должно содержать :digits цифр.',
    'digits_between' => 'Поле :attribute должно содержать от :min до :max цифр.',
    'dimensions' => 'У поля :attribute некорректные размеры изображения.',
    'distinct' => 'В поле :attribute содержится дублирующее значение.',
    'doesnt_contain' => 'Поле :attribute не должно содержать следующие значения: :values.',
    'doesnt_end_with' => 'Поле :attribute не должно заканчиваться одним из следующих значений: :values.',
    'doesnt_start_with' => 'Поле :attribute не должно начинаться с одного из следующих значений: :values.',
    'email' => 'Поле :attribute должно быть корректным адресом электронной почты.',
    'encoding' => 'Поле :attribute должно быть закодировано в :encoding.',
    'ends_with' => 'Поле :attribute должно заканчиваться одним из следующих значений: :values.',
    'enum' => 'Выбранное значение :attribute некорректно.',
    'exists' => 'Выбранное значение :attribute некорректно.',
    'extensions' => 'Поле :attribute должно иметь одно из следующих расширений: :values.',
    'file' => 'Поле :attribute должно быть файлом.',
    'filled' => 'Поле :attribute должно иметь значение.',
    'gt' => [
        'array' => 'Поле :attribute должно содержать больше :value элементов.',
        'file' => 'Размер файла в поле :attribute должен быть больше :value килобайт.',
        'numeric' => 'Значение поля :attribute должно быть больше :value.',
        'string' => 'Поле :attribute должно содержать больше :value символов.',
    ],
    'gte' => [
        'array' => 'Поле :attribute должно содержать :value элементов или больше.',
        'file' => 'Размер файла в поле :attribute должен быть не менее :value килобайт.',
        'numeric' => 'Значение поля :attribute должно быть не менее :value.',
        'string' => 'Поле :attribute должно содержать :value символов или больше.',
    ],
    'hex_color' => 'Поле :attribute должно быть корректным цветом в формате HEX.',
    'image' => 'Поле :attribute должно быть изображением.',
    'in' => 'Выбранное значение :attribute некорректно.',
    'in_array' => 'Значение поля :attribute должно существовать в :other.',
    'in_array_keys' => 'Поле :attribute должно содержать хотя бы один из следующих ключей: :values.',
    'integer' => 'Поле :attribute должно быть целым числом.',
    'ip' => 'Поле :attribute должно быть корректным IP-адресом.',
    'ipv4' => 'Поле :attribute должно быть корректным адресом IPv4.',
    'ipv6' => 'Поле :attribute должно быть корректным адресом IPv6.',
    'json' => 'Поле :attribute должно быть корректной строкой JSON.',
    'list' => 'Поле :attribute должно быть списком.',
    'lowercase' => 'Поле :attribute должно содержать только нижний регистр.',
    'lt' => [
        'array' => 'Поле :attribute должно содержать меньше :value элементов.',
        'file' => 'Размер файла в поле :attribute должен быть меньше :value килобайт.',
        'numeric' => 'Значение поля :attribute должно быть меньше :value.',
        'string' => 'Поле :attribute должно содержать меньше :value символов.',
    ],
    'lte' => [
        'array' => 'Поле :attribute должно содержать не более :value элементов.',
        'file' => 'Размер файла в поле :attribute должен быть не более :value килобайт.',
        'numeric' => 'Значение поля :attribute должно быть не более :value.',
        'string' => 'Поле :attribute должно содержать не более :value символов.',
    ],
    'mac_address' =>  'Поле :attribute должно быть корректным MAC-адресом.',
    'max' => [
        'array' => 'Поле :attribute не должно содержать больше :max элементов.',
        'file' => 'Размер файла в поле :attribute не должен превышать :max килобайт.',
        'numeric' => 'Значение поля :attribute не должно превышать :max.',
        'string' => 'Поле :attribute не должно содержать больше :max символов.',
    ],
    'max_digits' =>  'Поле :attribute не должно содержать больше :max цифр.',
    'mimes' => 'Поле :attribute должно быть файлом типа: :values.',
    'mimetypes' => 'Поле :attribute должно быть файлом типа: :values.',
    'min' => [
        'array' => 'Поле :attribute должно содержать как минимум :min элементов.',
        'file' => 'Размер файла в поле :attribute должен быть не менее :min килобайт.',
        'numeric' => 'Значение поля :attribute должно быть не менее :min.',
        'string' => 'Поле :attribute должно содержать как минимум :min символов.',
    ],
    'min_digits' =>  'Поле :attribute должно содержать не менее :min цифр.',
    'missing' => 'Поле :attribute должно отсутствовать.',
    'missing_if' =>  'Поле :attribute должно отсутствовать, когда :other равно :value.',
    'missing_unless' => 'Поле :attribute должно отсутствовать, если только :other не равно :value.',
    'missing_with' =>  'Поле :attribute должно отсутствовать, когда присутствуют :values.',
    'missing_with_all' => 'Поле :attribute должно отсутствовать, когда присутствуют все :values.',
    'multiple_of' => 'Поле :attribute должно быть кратным :value.',
    'not_in' =>  'Выбранный :attribute недопустим.',
    'not_regex' => 'Формат поля :attribute недействителен.',
    'numeric' => 'Поле :attribute должно быть числом.',
    'password' => [
        'letters' => 'Поле :attribute должно содержать хотя бы одну букву.',
        'mixed' => 'Поле :attribute должно содержать как минимум одну заглавную и одну строчную букву.',
        'numbers' => 'Поле :attribute должно содержать как минимум одну цифру.',
        'symbols' => 'Поле :attribute должно содержать как минимум один символ.',
        'uncompromised' => 'Данное значение :attribute фигурировало в утечке данных. Пожалуйста, выберите другое значение :attribute.',
    ],
    'present' => 'Поле :attribute должно быть заполнено.',
    'present_if' => 'Поле :attribute должно быть заполнено, когда :other равно :value.',
    'present_unless' => 'Поле :attribute должно быть заполнено, если только :other не равно :value.',
    'present_with' => 'Поле :attribute должно быть заполнено, когда :values заполнено.',
    'present_with_all' => 'Поле :attribute должно быть заполнено, когда все :values заполнены.',
    'prohibited' => 'Поле :attribute запрещено к заполнению.',
    'prohibited_if' => 'Поле :attribute запрещено к заполнению, когда :other равно :value.',
    'prohibited_if_accepted' => 'Поле :attribute запрещено к заполнению, когда :other принято.',
    'prohibited_if_declined' => 'Поле :attribute запрещено к заполнению, когда :other отклонено.',
    'prohibited_unless' => 'Поле :attribute запрещено к заполнению, если только :other не равно одному из :values.',
    'prohibits' => 'Поле :attribute запрещает наличие поля :other.',
    'regex' => 'Формат поля :attribute неверен.',
    'required' => 'Поле :attribute обязательно для заполнения.',
    'required_array_keys' => 'Поле :attribute должно содержать записи для: :values.',
    'required_if' => 'Поле :attribute обязательно для заполнения, когда :other равно :value.',
    'required_if_accepted' => 'Поле :attribute обязательно для заполнения, когда :other принято.',
    'required_if_declined' => 'Поле :attribute обязательно для заполнения, когда :other отклонено.',
    'required_unless' => 'Поле :attribute обязательно для заполнения, если только :other не равно одному из :values.',
    'required_with' => 'Поле :attribute обязательно для заполнения, когда :values заполнено.',
    'required_with_all' => 'Поле :attribute обязательно для заполнения, когда все :values заполнены.',
    'required_without' => 'Поле :attribute обязательно для заполнения, когда ни одно из :values не заполнено.',
    'required_without_all' => 'Поле :attribute обязательно для заполнения, когда ни одно из :values не заполнено.',
    'same' => 'Значения полей :attribute и :other должны совпадать.',
    'size' => [
        'array' => 'Поле :attribute должно содержать :size элементов.',
        'file' => 'Файл :attribute должен быть размером :size килобайт.',
        'numeric' => 'Значение поля :attribute должно быть равно :size.',
        'string' => 'Поле :attribute должно состоять из :size символов.'
    ],
    'starts_with' => 'Поле :attribute должно начинаться с одного из следующих значений: :values.',
    'string' => 'Поле :attribute должно быть строкой.',
    'timezone' => 'Значение поля :attribute должно быть допустимым часовым поясом.',
    'unique' => 'Значение :attribute уже существует.',
    'uploaded' => 'Не удалось загрузить файл :attribute.',
    'uppercase' => 'Поле :attribute должно состоять только из заглавных букв.',
    'url' => 'Поле :attribute должно быть допустимым URL-адресом.',
    'ulid' => 'Поле :attribute должно быть допустимым ULID.',
    'uuid' => 'Поле :attribute должно быть допустимым UUID.',

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
