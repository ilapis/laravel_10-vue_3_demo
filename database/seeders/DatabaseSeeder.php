<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //for all databases
        $this->seedOnce('seeded_languages:seedLanguage');
        $this->seedOnce('seeded_master_account:seedMasterAccount');

        if (app()->environment('production')) {
            ///add production only
        }
        if (app()->environment('staging')) {
            ///add staging only
        }
        if (app()->environment('local')) {
            ///add local only
        }
        if (app()->environment('testing')) {
            ///add testing only
        }
    }

    private function seedOnce(string $keyAndMethod): void
    {
        [$key, $method] = explode(':', $keyAndMethod);

        if ($this->checkSeedingDone($key)) {
            // Seeding already done, so return without seeding
            return;
        }

        // Execute the seeder
        call_user_func([$this, $method]);

        $this->updateSeedingDone($key);
    }

    private function checkSeedingDone($key): bool
    {
        $seedingDone = DB::table('configurations')->where('key', $key)->first();

        return $seedingDone && $seedingDone->value;
    }

    private function updateSeedingDone($key): void
    {
        DB::table('configurations')->updateOrInsert(
            ['key' => $key],
            [
                'value' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }

    private function seedMasterAccount(): void
    {
        $user = \App\Models\User::factory()->create([
            'name' => env('MASTER_NAME'),
            'email' => env('MASTER_EMAIL'),
            'password' => env('MASTER_PASSWORD'),
        ]);

        // Create a new ability if it doesn't exist
        $ability = \App\Models\Ability::firstOrCreate(['name' => '*']);

        // Attach the ability to the user
        $user->abilities()->syncWithoutDetaching([$ability->id]);
    }

    private function seedLanguage(): void
    {

        \App\Models\Language::factory(1)->create([
            'code' => 'lt',
            'name' => 'Lietuvių',
            'enabled' => true,
        ]);

        \App\Models\Language::factory(1)->create([
            'code' => 'en',
            'name' => 'English',
            'enabled' => true,
        ]);
    }
}
