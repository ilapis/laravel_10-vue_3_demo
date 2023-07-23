<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class TranslationUpdateRequest extends BaseRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $id = $this->route('translation'); // Fetch the ID from the route parameters.

        return [
            'language_id' => [
                'required',
                'integer',
                Rule::exists('languages', 'id'),
            ],
            'key' => [
                'required',
                'string',
                Rule::unique('translations', 'key')->ignore($id)->where(function ($query) {
                    return $query->where('key', $this->key);
                }),
            ],
            'value' => [
                'required',
                'string',
            ],
        ];
    }
}
