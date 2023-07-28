<?php

namespace App\Http\Requests;

class UserCreateRequest extends BaseRequest
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'abilities' => 'array', // abilities should be an array
            //'abilities.*' => 'exists:abilities,id', // each ability should exist in abilities table
            'abilities.*' => 'exists:abilities,name', // each ability should exist in abilities table by name
        ];
    }
}
