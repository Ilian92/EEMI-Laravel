<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Database\Seeder;

class CreatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crée 50 créateurs
        User::factory()
            ->count(50)
            ->create(['is_creator' => true])
            ->each(function ($creator) {
                // Pour chacun, génère entre 0 et 100 abonnements
                Subscription::factory()
                    ->count(rand(0, 100))
                    ->state(['creator_id' => $creator->id])
                    ->create();
            });
    }
}
