<?php

namespace App\Services;

use App\Data\UserData;
use App\Models\Ability;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function enabled(): Collection
    {
        return User::all();
        //return User::where('enabled', true)->filter()->get();//@TODO
    }

    /**
     * @return LengthAwarePaginator<User>
     */
    public function list(int $perPage = 15): LengthAwarePaginator
    {
        return User::orderBy('id', 'desc')->with('abilities')->filter()->paginate($perPage)->withQueryString();
    }

    public function create(UserData $userData): User
    {
        $user = User::create($userData->toArray());

        $abilities = $userData->abilities;

        // If no abilities provided, use default
        if (empty($abilities)) {
            $abilities = ['user_registered'];
        }

        // Get ability models from ability names
        $abilityModels = Ability::whereIn('name', $abilities)->get();

        // Attach abilities to the user
        $user->abilities()->sync($abilityModels);

        return $user;
    }

    public function update(User $user, UserData $userData): ?User
    {
        $user->update($userData->toArray());

        $abilities = $userData->abilities;

        // If no abilities provided, do not change existing abilities
        if (! empty($abilities)) {
            // Get ability models from ability names
            $abilityModels = Ability::whereIn('name', $abilities)->get();

            // Sync abilities with the user
            $user->abilities()->sync($abilityModels);
        }

        return $user->fresh();
    }

    public function delete(User $user): ?User
    {
        $user->delete();

        return $user->fresh();
    }
}
