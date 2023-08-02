<?php

namespace App\Http\Requests;

class LanguageCreateRequest extends BaseRequest
{
    public function permissions(): array
    {
        return ['can_create_language'];
    }

    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string|unique:languages',
            'name' => 'required|string',
            'enabled' => 'required|boolean',
        ];
    }
}
