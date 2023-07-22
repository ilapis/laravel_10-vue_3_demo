<?php

namespace App\Traits;

use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

trait HandlesAbilities
{
    private function checkAbility(User $user, string $ability): bool
    {
        /**
         * @var PersonalAccessToken $existingToken
         */
        $existingToken = $user->tokens->first();

        return ! empty(array_intersect(['*', $ability], $existingToken->abilities ?? []));
    }
}
