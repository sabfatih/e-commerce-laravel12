<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'store_id' => Store::factory(),
            'name' => fake()->word(),
            'description' => fake()->text(),
            'price' => fake()->randomFloat(2, 0, 1500),
            'stock' => fake()->randomNumber(2, true),
            'weight' => fake()->randomFloat(2, 0, 1000),
        ];
    }
}
