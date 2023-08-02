<?php

namespace App\Data;

class ArticleData extends BaseData
{
    public string $title;

    public string $text;

    public string $tags = '[]';

    public int $language_id;

    public int $user_id;

    protected function rules(): array
    {
        return [
            'title' => 'required|string|min:5|max:255',
            'text' => 'required|string',
            'language_id' => 'required|int',
            'user_id' => 'required|int',
            'tags' => 'string|max:255',
        ];
    }
}
