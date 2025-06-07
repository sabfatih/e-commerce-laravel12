<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
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
          'amount' => fake()->randomFloat(2, 0, 1000000),
          'payment_status' => fake()->randomElement(['pending', 'completed', 'failed']),
          'payment_method' => fake()->randomElement(['cash_on_delivery', 'credit_card', 'paypal']),
          'payment_date' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
