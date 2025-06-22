<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('fr_FR');

        // Get or create a user
        $user = User::first() ?? User::factory()->create();

        // Create 5 posts
        for ($i = 0; $i < 5; $i++) {
            Post::create([
                'user_id' => $user->id,
                'content' => $faker->realText(200),
                'is_published' => 1,
                'image_path' => 'posts/Zh4JFq18xxLFC98NeJNBBkL1Ja6tVdqE4u8mp8Wu.png',
                'created_at' => $faker->dateTimeBetween('-1 month', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}