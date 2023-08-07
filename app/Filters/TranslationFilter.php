<?php

namespace App\Filters;

class TranslationFilter
{
    public const SORTABLE = ['id', 'language_id', 'key', 'name'];

    public const FILTERABLE = [
        'language_id' => ['exact'],
        'key' => ['contains'],
        'value' => ['contains'],
    ];
}
