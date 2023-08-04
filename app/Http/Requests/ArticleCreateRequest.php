<?php

namespace App\Http\Requests;

class ArticleCreateRequest extends BaseRequest
{
    public function permissions(): array
    {
        return ['can_create_article'];
    }

    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required','string','min:5','max:255'],
            'text' => 'required|string',
            'language_id' => 'required|int',
            'user_id' => 'required|int',
            'tags' => 'string|max:255',
        ];
    }
}
