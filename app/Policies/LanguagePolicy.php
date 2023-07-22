<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Traits\HandlesAbilities;

class LanguagePolicy
{
    use HandlesAuthorization;
    use HandlesAbilities;

    public function create(User $user): bool
    {
        return $this->checkAbility($user, 'can_create_language');;
    }

    public function update(User $user): bool
    {
        return $this->checkAbility($user, 'can_update_language');;
    }
}
