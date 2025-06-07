<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
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
          'order_id' => Order::factory(),
          'product_id' => Product::factory(),
          'quantity' => fake()->randomNumber(2),
          'price' => fake()->randomFloat(2, 0, 1000000),
        ];
    }
}
