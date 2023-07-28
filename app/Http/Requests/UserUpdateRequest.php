<?php

namespace App\Http\Requests;

class UserUpdateRequest extends BaseRequest
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        $id = $this->route('user')->id; // Fetch the ID from the route parameters.

        return [
            'name' => 'required|string|max:255|unique:users,name,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|required_with:password_confirmation|string|min:8|confirmed',
            'password_confirmation' => 'sometimes|string|min:8',
            'abilities' => 'required|array',
            'abilities.*' => 'string', // Every item in the abilities array must be a string.
        ];
    }
}
