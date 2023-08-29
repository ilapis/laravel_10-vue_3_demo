<?php

namespace App\Filters;

class LanguageFilter
{
    public const SORTABLE = ['id', 'code', 'name'];

    public const FILTERABLE = [
        'code' => ['exact'],
        'name' => ['contains'],
    ];
}
