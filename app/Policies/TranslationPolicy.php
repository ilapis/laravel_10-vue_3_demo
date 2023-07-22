<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use \App\Traits\HandlesAbilities;

class TranslationPolicy
{
    use HandlesAuthorization;
    use HandlesAbilities;

    public function create(User $user): bool
    {
        return $this->checkAbility($user, 'can_create_translation');;
    }

    public function update(User $user): bool
    {
        return $this->checkAbility($user, 'can_update_translation');;
    }

    public function delete(User $user): bool
    {
        return $this->checkAbility($user, 'can_delete_translation');;
    }
}
