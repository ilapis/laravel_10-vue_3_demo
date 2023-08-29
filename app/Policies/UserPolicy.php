<?php

namespace App\Policies;

use App\Models\User;
use App\Traits\HandlesAbilities;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    use HandlesAbilities;

    public function view(User $user): bool
    {
        return $this->checkAbility($user, 'can_view_user');
    }

    public function create(User $user): bool
    {
        return $this->checkAbility($user, 'can_create_user');
    }

    public function update(User $user): bool
    {
        return $this->checkAbility($user, 'can_update_user');
    }

    public function delete(User $user): bool
    {
        return $this->checkAbility($user, 'can_delete_user');
    }
}
