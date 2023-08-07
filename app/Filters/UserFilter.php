<?php

namespace App\Filters;

class UserFilter
{
    public const SORTABLE = ['id', 'name', 'email'];

    public const FILTERABLE = [
        'name' => ['contains'],
        'email' => ['contains'],
    ];
}
