<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Review;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    // 1. Buat user khusus + user random
    $userFatih = User::create([
      'id' => (string) Str::uuid(),
      'name' => 'Sabihisma Fatih',
      'username' => 'sabfatiih',
      'email' => 'fatih@gmail.com',
      'email_verified_at' => now(),
      'password' => Hash::make('fatih'),
      'remember_token' => Str::random(10),
      'is_admin' => true,
    ]);

    $users = User::factory(7)->create();
    $allUsers = $users->push($userFatih);

    // 2. Buat categories custom (7 kategori umum)
    $categoryNames = ['Clothes', 'Furniture', 'Electronics', 'Books', 'Toys', 'Foods', 'Beauty'];
    $categories = collect();
    foreach ($categoryNames as $name) {
      $categories->push(Category::factory()->create(['name' => $name, 'slug' => Str::slug($name)]));
    }

    // 3. Buat products dan attach ke categories
    $products = Product::factory(30)->create();
    $products->each(function ($product) use ($categories) {
      $product->categories()->attach(
        $categories->random(rand(1, 3))->pluck('id')->toArray()
      );
    });
    

    // 4. Product images (1-3 gambar per product)
    $products->each(function ($product) {
      ProductImage::factory()->create(['product_id' => $product->id, 'is_primary' => true]);
      ProductImage::factory(rand(0, 4))->create(['product_id' => $product->id]);
    });


    // 6. Cart items (unik cart_id + product_id)
    $cartProductPairs = collect();
    $maxCartItems = 80;
    $count = 0;
    while ($count < $maxCartItems) {
      $user = $allUsers->random();
      $product = $products->random();
      $key = $user->id . '-' . $product->id;
      if (!$cartProductPairs->contains($key)) {
        CartItem::factory()->create([
          'user_id' => $user->id,
          'product_id' => $product->id,
        ]);
        $cartProductPairs->push($key);
        $count++;
      }
    }

    // 7. Wishlists dan isinya (user bisa punya 1-3 wishlist, nama unik)
    $wishlists = collect();
    foreach ($allUsers as $user) {
      $numWishlists = rand(1, 3);
      for ($i = 1; $i <= $numWishlists; $i++) {
        $wishlists->push(Wishlist::factory()->create([
          'user_id' => $user->id,
          'name' => $user->name . "'s wishlist #" . $i
        ]));
      }
    }

    // Wishlist items unik wishlist_id + product_id
    $wishlistProductPairs = collect();
    foreach ($wishlists as $wishlist) {
      $numItems = rand(1, 5);
      $productsSample = $products->random($numItems);
      foreach ($productsSample as $product) {
        $key = $wishlist->id . '-' . $product->id;
        if (!$wishlistProductPairs->contains($key)) {
          WishlistItem::factory()->create([
            'wishlist_id' => $wishlist->id,
            'product_id' => $product->id,
          ]);
          $wishlistProductPairs->push($key);
        }
      }
    }

    // 8. Orders (1-3 order per user)
    $orders = $allUsers->flatMap(fn($user) => Order::factory(rand(1,3))->create(['user_id' => $user->id]));

    // 9. Order items unik order_id + product_id
    $orderProductPairs = collect();
    foreach ($orders as $order) {
      $numItems = rand(1, 5);
      $productsSample = $products->random($numItems);
      foreach ($productsSample as $product) {
        $key = $order->id . '-' . $product->id;
        if (!$orderProductPairs->contains($key)) {
          OrderItem::factory()->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
          ]);
          $orderProductPairs->push($key);
        }
      }
    }

    // 10. Payments and update status order
    $orders->random(8)->each(function ($order) {
      Payment::factory()->create(['order_id' => $order->id]);
      $order->update(['status' => collect(['processing','shipped','delivered'])->random()]);
    });

    // 11. Reviews unique (user_id + product_id)
    $reviewPairs = collect();
    while ($reviewPairs->count() < 30) {
      $user = $allUsers->random();
      $product = $products->random();
      $key = $user->id . '-' . $product->id;

      if (!$reviewPairs->contains($key)) {
        Review::factory()->create([
          'user_id' => $user->id,
          'product_id' => $product->id,
        ]);
        $reviewPairs->push($key);
      }
    }
  }
}
