<?php

namespace App\Http\Requests;

class LanguageUpdateRequest extends BaseRequest
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string',
            'name' => 'required|string',
            'enabled' => 'required|boolean',
        ];
    }
}
