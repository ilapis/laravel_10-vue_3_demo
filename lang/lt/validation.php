<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validacijos Kalbos Eilutės
    |--------------------------------------------------------------------------
    |
    | Šioje kalbų eilutėje yra numatytos klaidų pranešimų reikšmės, kurias naudoja
    | patvirtinimo klasė. Kai kurioms taisyklėms yra kelios versijos,
    | pvz., dydžio taisyklėms. Čia galite pakeisti kiekvieną iš šių pranešimų.
    |
    */

    'accepted' => ':attribute laukelis turi būti priimtas.',
    'accepted_if' => ':attribute laukelis turi būti priimtas, kai :other yra :value.',
    'active_url' => ':attribute laukas turi būti galiojantis URL.',
    'after' => ':attribute laukas turi būti data po :date.',
    'after_or_equal' => ':attribute laukas turi būti data po arba lygi :date.',
    'alpha' => ':attribute laukas gali turėti tik raides.',
    'alpha_dash' => ':attribute laukas gali turėti tik raides, skaičius, brūkšnius ir pabraukimus.',
    'alpha_num' => ':attribute laukas gali turėti tik raides ir skaičius.',
    'array' => ':attribute laukas turi būti masyvas.',
    'ascii' => ':attribute laukas gali turėti tik vienos baito alfanumerinius simbolius ir simbolius.',
    'before' => ':attribute laukas turi būti data prieš :date.',
    'before_or_equal' => ':attribute laukas turi būti data prieš arba lygi :date.',
    'between' => [
        'array' => ':attribute laukas turi turėti nuo :min iki :max elementų.',
        'file' => ':attribute laukas turi būti tarp :min ir :max kilobaitų.',
        'numeric' => ':attribute laukas turi būti tarp :min ir :max.',
        'string' => ':attribute laukas turi būti tarp :min ir :max simbolių.',
    ],
    'boolean' => ':attribute laukas turi būti teisingas arba neteisingas.',
    'can' => ':attribute laukas turi neteisingą reikšmę.',
    'confirmed' => ':attribute laukas patvirtinimas nesutampa.',
    'current_password' => 'Slaptažodis yra neteisingas.',
    'date' => ':attribute laukas turi būti galiojanti data.',
    'date_equals' => ':attribute laukas turi būti data lygi :date.',
    'date_format' => ':attribute laukas neatitinka formato :format.',
    'decimal' => ':attribute laukas turi turėti :decimal dešimtainių vietų.',
    'declined' => ':attribute laukas turi būti atmestas.',
    'declined_if' => ':attribute laukas turi būti atmestas, kai :other yra :value.',
    'different' => ':attribute laukas ir :other turi būti skirtingi.',
    'digits' => ':attribute laukas turi būti :digits skaitmenys.',
    'digits_between' => ':attribute laukas turi būti tarp :min ir :max skaitmenų.',
    'dimensions' => ':attribute lauko paveikslėlio matmenys yra netinkami.',
    'distinct' => ':attribute laukas turi dublikuotą reikšmę.',
    'doesnt_end_with' => ':attribute laukas turi nesibaigti vienu iš šių: :values.',
    'doesnt_start_with' => ':attribute laukas turi neprasidėti vienu iš šių: :values.',
    'email' => ':attribute laukas turi būti galiojantis el. pašto adresas.',
    'ends_with' => ':attribute laukas turi baigtis vienu iš šių: :values.',
    'enum' => 'Pasirinktas :attribute yra neteisingas.',
    'exists' => 'Pasirinktas :attribute yra neteisingas.',
    'file' => ':attribute laukas turi būti failas.',
    'filled' => ':attribute laukas turi turėti reikšmę.',
    'gt' => [
        'array' => ':attribute laukas turi turėti daugiau nei :value elementų.',
        'file' => ':attribute laukas turi būti didesnis nei :value kilobaitai.',
        'numeric' => ':attribute laukas turi būti didesnis nei :value.',
        'string' => ':attribute laukas turi būti ilgesnis nei :value simboliai.',
    ],
    'gte' => [
        'array' => ':attribute laukas turi turėti :value elementus arba daugiau.',
        'file' => ':attribute laukas turi būti didesnis arba lygus :value kilobaitams.',
        'numeric' => ':attribute laukas turi būti didesnis arba lygus :value.',
        'string' => ':attribute laukas turi būti ilgesnis arba lygus :value simboliams.',
    ],
    'image' => ':attribute laukas turi būti paveikslėlis.',
    'in' => 'Pasirinktas :attribute yra neteisingas.',
    'in_array' => ':attribute laukas turi egzistuoti :other.',
    'integer' => ':attribute laukas turi būti sveikasis skaičius.',
    'ip' => ':attribute laukas turi būti galiojantis IP adresas.',
    'ipv4' => ':attribute laukas turi būti galiojantis IPv4 adresas.',
    'ipv6' => ':attribute laukas turi būti galiojantis IPv6 adresas.',
    'json' => ':attribute laukas turi būti galiojantis JSON eilutė.',
    'lowercase' => ':attribute laukas turi būti mažosiomis raidėmis.',
    'lt' => [
        'array' => ':attribute laukas turi turėti mažiau nei :value elementus.',
        'file' => ':attribute laukas turi būti mažesnis nei :value kilobaitai.',
        'numeric' => ':attribute laukas turi būti mažesnis nei :value.',
        'string' => ':attribute laukas turi būti trumpesnis nei :value simboliai.',
    ],
    'lte' => [
        'array' => ':attribute laukas turi turėti ne daugiau kaip :value elementus.',
        'file' => ':attribute laukas turi būti mažesnis arba lygus :value kilobaitams.',
        'numeric' => ':attribute laukas turi būti mažesnis arba lygus :value.',
        'string' => ':attribute laukas turi būti trumpesnis arba lygus :value simboliams.',
    ],
    'mac_address' => ':attribute laukas turi būti galiojantis MAC adresas.',
    'max' => [
        'array' => ':attribute laukas turi neturėti daugiau nei :max elementų.',
        'file' => ':attribute laukas negali būti didesnis nei :max kilobaitai.',
        'numeric' => ':attribute laukas negali būti didesnis nei :max.',
        'string' => ':attribute laukas negali būti didesnis nei :max simboliai.',
    ],
    'max_digits' => ':attribute laukas negali turėti daugiau nei :max skaitmenų.',
    'mimes' => ':attribute laukas turi būti failo tipas: :values.',
    'mimetypes' => ':attribute laukas turi būti failo tipas: :values.',
    'min' => [
        'array' => ':attribute laukas turi turėti bent :min elementus.',
        'file' => ':attribute laukas turi būti bent :min kilobaitai.',
        'numeric' => ':attribute laukas turi būti bent :min.',
        'string' => ':attribute laukas turi būti bent :min simboliai.',
    ],
    'min_digits' => ':attribute laukas turi turėti bent :min skaitmenis.',
    'missing' => ':attribute laukas turi būti prarastas.',
    'missing_if' => ':attribute laukas turi būti prarastas, kai :other yra :value.',
    'missing_unless' => ':attribute laukas turi būti prarastas, nebent :other yra :value.',
    'missing_with' => ':attribute laukas turi būti prarastas, kai :values yra pateikta.',
    'missing_with_all' => ':attribute laukas turi būti prarastas, kai :values yra pateikti.',
    'multiple_of' => ':attribute laukas turi būti :value kartotinis.',
    'not_in' => 'Pasirinktas :attribute yra neteisingas.',
    'not_regex' => ':attribute lauko formatas yra neteisingas.',
    'numeric' => ':attribute laukas turi būti skaičius.',
    'password' => [
        'letters' => ':attribute lauke turi būti bent viena raidė.',
        'mixed' => ':attribute lauke turi būti bent viena didžioji ir mažoji raidė.',
        'numbers' => ':attribute lauke turi būti bent vienas skaičius.',
        'symbols' => ':attribute lauke turi būti bent vienas simbolis.',
        'uncompromised' => 'Duotas :attribute buvo paviešintas duomenų nutekėjime. Prašome pasirinkti kitą :attribute.',
    ],
    'present' => ':attribute laukas turi būti pateiktas.',
    'prohibited' => ':attribute laukas yra draudžiamas.',
    'prohibited_if' => ':attribute laukas yra draudžiamas, kai :other yra :value.',
    'prohibited_unless' => ':attribute laukas yra draudžiamas, nebent :other yra :values.',
    'prohibits' => ':attribute laukas draudžia :other būti pateiktam.',
    'regex' => ':attribute lauko formatas yra neteisingas.',
    'required' => ':attribute laukas yra privalomas.',
    'required_array_keys' => ':attribute laukas turi turėti įrašus: :values.',
    'required_if' => ':attribute laukas yra privalomas, kai :other yra :value.',
    'required_if_accepted' => ':attribute laukas yra privalomas, kai :other yra priimtas.',
    'required_unless' => ':attribute laukas yra privalomas, nebent :other yra :values.',
    'required_with' => ':attribute laukas yra privalomas, kai :values yra pateikti.',
    'required_with_all' => ':attribute laukas yra privalomas, kai :values yra pateikti.',
    'required_without' => ':attribute laukas yra privalomas, kai :values nėra pateikti.',
    'required_without_all' => ':attribute laukas yra privalomas, kai :values nėra pateikti.',
    'same' => ':attribute laukas turi sutapti su :other.',
    'size' => [
        'array' => ':attribute laukas turi turėti :size elementus.',
        'file' => ':attribute laukas turi būti :size kilobaitai.',
        'numeric' => ':attribute laukas turi būti :size.',
        'string' => ':attribute laukas turi būti :size simboliai.',
    ],
    'starts_with' => ':attribute laukas turi prasidėti vienu iš šių: :values.',
    'string' => ':attribute laukas turi būti eilutė.',
    'timezone' => ':attribute laukas turi būti galiojantis laiko juosta.',
    'unique' => ':attribute jau yra panaudotas.',
    'uploaded' => ':attribute nepavyko įkelti.',
    'uppercase' => ':attribute laukas turi būti didžiosiomis raidėmis.',
    'url' => ':attribute laukas turi būti galiojantis URL.',
    'ulid' => ':attribute laukas turi būti galiojantis ULID.',
    'uuid' => ':attribute laukas turi būti galiojantis UUID.',

    /*
    |--------------------------------------------------------------------------
    | Individualių Validacijos Kalbos Eilutės
    |--------------------------------------------------------------------------
    |
    | Čia galite nurodyti individualias validacijos žinutes atributams,
    | naudodami konvenciją "attribute.rule", kad pavadintumėte eilutes.
    | Tai padeda greitai nurodyti konkretų adaptuotą kalbos lauką.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Individualios Validacijos Atributų Kalbos Eilutės
    |--------------------------------------------------------------------------
    |
    | Šios kalbos eilutės naudojamos pakeičiant atributų pakeitimo vietą
    | į kažką, kas yra aiškesnis ir suprantamesnis, pvz., "El. Pašto Adresas"
    | vietoj "email". Tai padeda mūsų pranešimams tapti aiškesniems.
    |
    */

    'attributes' => [],

];
