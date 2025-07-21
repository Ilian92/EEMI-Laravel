<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'user@mail.com',
            'username' => 'johndoe',
            'password' => Hash::make('password'),
            'bio' => 'Passionate about feet photography 📸',
            'is_creator' => true,
            'creator_since' => now(),
            'subscription_price' => 9.99,
            'profile_picture' => null,
            'banner_image' => null,
        ]);
    }
}