<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Laravel\Sanctum\PersonalAccessToken;

class TranslationPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        /**
         * @var PersonalAccessToken $existingToken
         */
        $existingToken = $user->tokens->first();

        return ! empty(array_intersect(['can_create_translation'], $existingToken->abilities));
    }

    public function update(User $user): bool
    {
        /**
         * @var PersonalAccessToken $existingToken
         */
        $existingToken = $user->tokens->first();

        return ! empty(array_intersect(['can_update_translation'], $existingToken->abilities));
    }

    public function destroy(User $user): bool
    {
        /**
         * @var PersonalAccessToken $existingToken
         */
        $existingToken = $user->tokens->first();

        return ! empty(array_intersect(['can_destroy_translation'], $existingToken->abilities));
    }
}
