<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class LanguageUpdateRequest extends BaseRequest
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        $id = $this->route('language'); // Fetch the ID from the route parameters.

        return [
            'code' => [
                'required',
                'string',
                Rule::unique('languages', 'code')->ignore($id)->where(function ($query) {
                    return $query->where('code', $this->code);
                }),
            ],
            'name' => 'required|string',
            'enabled' => 'required|boolean',
        ];
    }
}
