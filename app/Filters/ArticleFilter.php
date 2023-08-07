<?php

namespace App\Filters;

class ArticleFilter
{
    public const SORTABLE = ['id', 'language_id', 'title'];

    public const FILTERABLE = [
        'language_id' => ['exact'],
        'title' => ['contains'],
        'text' => ['contains'],
    ];
}
