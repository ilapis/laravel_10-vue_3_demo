<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class TranslationCreateRequest extends BaseRequest
{
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
            'key' => [
                'required',
                'string',
                Rule::unique('translations')->where(function ($query) {
                    return $query->where('language_id', $this->language_id);
                }),
            ],
            'value' => [
                'required',
                'string',
            ],
        ];
    }
}
