<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WishlistItem>
 */
class WishlistItemFactory extends Factory
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
          'wishlist_id' => Wishlist::factory(),
          'product_id' => Product::factory(),
        ];
    }
}
