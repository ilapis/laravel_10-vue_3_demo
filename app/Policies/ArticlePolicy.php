<?php

namespace App\Policies;

use App\Models\User;
use App\Traits\HandlesAbilities;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;
    use HandlesAbilities;

    public function create(User $user): bool
    {
        return $this->checkAbility($user, 'can_create_article');
    }

    public function update(User $user): bool
    {
        return $this->checkAbility($user, 'can_update_article');
    }

    public function delete(User $user): bool
    {
        return $this->checkAbility($user, 'can_delete_article');
    }
}
