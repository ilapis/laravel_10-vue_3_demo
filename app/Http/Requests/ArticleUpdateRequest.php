<?php

namespace App\Http\Requests;

use Dive\DryRequests\DryRunnable;
use Illuminate\Validation\Rule;

class ArticleUpdateRequest extends BaseRequest
{
    use DryRunnable;

    public function permissions(): array
    {
        return ['can_update_article'];
    }

    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        $articleId = $this->route('article'); // Assuming the article's ID is in the route parameter

        return [
            'title' => [
                'required',
                'string',
                'min:5',
                'max:255',
                Rule::unique('articles')->ignore($articleId)->where(function ($query) {
                    return $query->where('language_id', $this->input('language_id'));
                }),
            ],
            'text' => 'required|string',
            'language_id' => 'required|int',
            'user_id' => 'required|int',
            'tags' => 'string|max:255',
        ];
    }
}
