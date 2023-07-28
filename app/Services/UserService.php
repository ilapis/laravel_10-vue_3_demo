<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Models\User;
use App\Models\Ability;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    /**
     * @return LengthAwarePaginator<User>
     */
    public function list(int $perPage = 15): LengthAwarePaginator
    {
        return User::orderBy('id', 'desc')->with('abilities')->filter()->paginate($perPage)->withQueryString();
    }

    public function create(UserDTO $userDTO): User
    {
        $user = User::create($userDTO->getAttributes());

        $abilities = $userDTO->abilities;

        // If no abilities provided, use default
        if (empty($abilities)) {
            $abilities = ['registered_user'];
        }

        // Get ability models from ability names
        $abilityModels = Ability::whereIn('name', $abilities)->get();

        // Attach abilities to the user
        $user->abilities()->sync($abilityModels);

        return $user;
    }

    public function update(User $user, UserDTO $userDTO): User
    {
        $user->update($userDTO->getAttributes());

        $abilities = $userDTO->abilities;

        // If no abilities provided, do not change existing abilities
        if (!empty($abilities)) {
            // Get ability models from ability names
            $abilityModels = Ability::whereIn('name', $abilities)->get();

            // Sync abilities with the user
            $user->abilities()->sync($abilityModels);
        }

        return $user;
    }
}
