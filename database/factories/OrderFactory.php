<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
          'status' => fake()->randomElement(['pending','processing','shipped','delivered','cancelled','refunded']),
          'total_price' => fake()->randomFloat(2, 0, 1000000),
          'shipping_address' => fake()->streetAddress(),
          'payment_method' => fake()->randomElement(['cash_on_delivery', 'credit_card', 'paypal']),

        ];
    }
}
