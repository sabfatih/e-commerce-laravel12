<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'id' => (string) Str::uuid(),
          'user_id' => User::factory(),
          'name' => fake()->company(),
          'description' => fake()->optional()->text(),
          'type' => fake()->optional()->randomElement(['Power Merchant Pro', 'Official Store', 'Power Merchant']),
          'is_active' => fake()->boolean(),
          'address' => fake()->optional()->streetAddress(),
          'phone' => fake()->optional()->phoneNumber(),
          'image_url' => fake()->optional()->imageUrl(),
        ];
    }
}
