<?php

namespace App\Http\Requests;

class UserUpdateRequest extends BaseRequest
{
    public function permissions(): array
    {
        return ['can_update_user'];
    }

    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        $user = $this->route('user');

        if (! ($user instanceof \App\Models\User)) {
            throw new \RuntimeException('Invalid user route parameter');
        }

        $id = $user->id;

        return [
            'name' => 'required|string|max:255|unique:users,name,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'sometimes|required_with:password_confirmation|string|min:8|confirmed',
            'password_confirmation' => 'sometimes|string|min:8',
            'abilities' => 'required|array',
            'abilities.*' => 'string', // Every item in the abilities array must be a string.
        ];
    }
}
