<?php

namespace App\Filters;

class TranslationFilter
{
    public const SORTABLE = ['translations.id', 'language.name', 'key', 'name'];

    public const FILTERABLE = [
        'language.name' => ['exact'],
        'key' => ['contains'],
        'value' => ['contains'],
    ];
}
