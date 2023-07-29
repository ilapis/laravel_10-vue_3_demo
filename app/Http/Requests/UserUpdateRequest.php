<?php

namespace App\Http\Requests;

class UserUpdateRequest extends BaseRequest
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        $user = $this->route('user');

        if (is_object($user) && property_exists($user, 'id')) {
            $id = $user->id;
        } else {
            // Handle the case where user is not an object or doesn't have an id property.
            // For example, you could throw an exception:
            throw new \RuntimeException('Invalid user route parameter');
        }

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
