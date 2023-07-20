<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Laravel\Sanctum\PersonalAccessToken;

class LanguagePolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        /**
         * @var PersonalAccessToken $existingToken
         */
        $existingToken = $user->tokens->first();

        return ! empty(array_intersect(['can_create_language'], $existingToken->abilities));
    }

    public function update(User $user): bool
    {
        /**
         * @var PersonalAccessToken $existingToken
         */
        $existingToken = $user->tokens->first();

        return ! empty(array_intersect(['can_update_language'], $existingToken->abilities));
    }
}
