<?php

namespace App\Console\Commands;

use App\Models\Ability;
use App\Models\User;
use Illuminate\Console\Command;

class AssignAbility extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:assign-ability {userId} {abilityId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign an ability to a user';

    public function handle(): void
    {
        $userId = $this->argument('userId');
        $abilityId = $this->argument('abilityId');

        $user = User::find($userId);
        $ability = Ability::find($abilityId);

        if (!$user) {
            $this->error("User with ID $userId not found.");
            return;
        }

        if (!$ability) {
            $this->error("Ability with ID $abilityId not found.");
            return;
        }

        if ($user->abilities->contains($ability)) {
            $this->info("User {$user->name} already has ability {$ability->name}.");
            return;
        }

        $user->abilities()->attach($ability);

        $this->info("Ability {$ability->name} assigned to user {$user->name}.");
    }
}
