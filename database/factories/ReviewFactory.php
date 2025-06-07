<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
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
          'product_id' => Product::factory(),
          'rating' => fake()->numberBetween(1, 5),
          'comment' => fake()->text(),
        ];
    }
}
