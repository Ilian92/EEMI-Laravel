<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Faker\Factory;

class PostsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('fr_FR');

        // Make sure we have at least one user
        $user = User::first() ?? User::factory()->create();

        // Create 5 fake posts
        for ($i = 0; $i < 5; $i++) {
            Post::create([
                'content' => $faker->paragraph(2),
                'user_id' => $user->id,
                'is_published' => 1,
                'image_path' => NULL,
                'created_at' => $faker->dateTimeBetween('-1 month', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}