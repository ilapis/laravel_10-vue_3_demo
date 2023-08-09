<?php

namespace App\Http\Requests;

use Dive\DryRequests\DryRunnable;

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
        return [
            'title' => 'required|string|min:5|max:255',
            'text' => 'required|string',
            'language_id' => 'required|int',
            'user_id' => 'required|int',
            'tags' => 'string|max:255',
        ];
    }
}
