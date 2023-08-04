<?php

namespace App\Http\Requests;

class ArticleDeleteRequest extends BaseRequest
{
    public function permissions(): array
    {
        return ['can_delete_article'];
    }
}
