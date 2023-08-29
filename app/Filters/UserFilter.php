<?php

namespace App\Filters;

class UserFilter
{
    public const SORTABLE = ['id', 'name', 'email'];

    public const FILTERABLE = [
        'name' => ['contains', 'starts_with', 'exact', 'not_equal', 'ends_with'],
        'email' => ['contains'],
        'created_at' => ['min', 'max'],
    ];
}
