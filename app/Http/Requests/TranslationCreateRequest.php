<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class TranslationCreateRequest extends BaseRequest
{
    public function permissions(): array
    {
        return ['can_create_translation'];
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'language_id' => [
                'required',
                'integer',
                Rule::exists('languages', 'id'),
            ],
            'group' => [
                'required',
                'string',
            ],
            'key' => [
                'required',
                'string',
                Rule::unique('translations')->where(function ($query) {
                    return $query->where('language_id', $this->language_id)
                        ->where('group', $this->group);
                }),
            ],
            'value' => [
                'required',
                'string',
            ],
        ];
    }
}
