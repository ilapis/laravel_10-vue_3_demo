<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BaseRequest extends FormRequest
{
    /**
     * @return array<string>
     */
    public function permissions(): array
    {
        return ['*']; //default All
    }

    protected function allow(): bool
    {

        if ($user = $this->user()) {
            $loaded = $user->load('abilities');

            $allAbilities = array_merge(['*', ...$this->permissions()]);

            return in_array('*', $this->permissions()) || $loaded->abilities->whereIn('name', $allAbilities)->isNotEmpty();
        }

        return true;
    }

    public function authorize(): bool
    {
        return $this->allow();
    }

    /**
     * @return array<string, array<string>|string>
     */
    public function rules(): array
    {
        return [];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'errors' => $validator->errors(),
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
