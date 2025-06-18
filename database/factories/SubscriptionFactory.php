<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'creator_id'    => User::factory(),
            'subscriber_id' => User::factory(),
            'amount'        => fake()->randomFloat(2, 5, 100),
            'created_at'    => $this->faker->dateTimeBetween('-1 year'),
            'expires_at'    => fake()->dateTimeBetween('+1 month', '+1 year'),
        ];
    }
}
