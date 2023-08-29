<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class TranslationUpdateRequest extends BaseRequest
{
    public function permissions(): array
    {
        return ['can_update_translation'];
    }

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
                })->ignore($id),
            ],
            'value' => [
                'required',
                'string',
            ],
        ];
    }
}
