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

        $images = [
            '1752680868_6877c9a47a7bc.png',
            '1752680893_6877c9bd239ff.png',
            '1752682068_6877ce5462931.png',
            '8dor2C61Bkf9qHEq5zOY5uXDrfwnQ46611m6SzNa.png',
            'H8vy3VDN8wdQUlVgqoRJahbLGzV9zrbCZLhC1Hx6.png',
            'LoKNZexq8ntftoYJ2QRt188vkMlYsGaN2ALB7rES.jpg',
            'Zh4JFq18xxLFC98NeJNBBkL1Ja6tVdqE4u8mp8Wu.png',
            'ztLSXRDKPtptmTYN5l2ZER0weZZS6kdWY4DhC8l6.png',
        ];

        // Récupère tous les créateurs (users avec is_creator=1)
        $creators = User::where('is_creator', 1)->get();

        foreach ($creators as $creator) {
            // Au moins 1 post par créateur
            $numPosts = rand(1, 5); // entre 1 et 5 posts par créateur

            for ($i = 0; $i < $numPosts; $i++) {
                Post::create([
                    'user_id' => $creator->id,
                    'content' => $faker->realText(200),
                    'is_published' => 1,
                    // /home/thomas/Documents/2024-2025/Laravel/EEMI-Laravel/storage/app/public/posts/LoKNZexq8ntftoYJ2QRt188vkMlYsGaN2ALB7rES.jpg
                    'image_path' => 'posts/' . $faker->randomElement($images),
                    'created_at' => $faker->dateTimeBetween('-1 month', 'now'),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
