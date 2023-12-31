<?php

namespace App\Data;

class ArticleData extends BaseData
{
    public ?int $id;

    public string $title;

    public string $text;

    public string $tags = '[]';

    public int $language_id;

    public int $user_id;
}
