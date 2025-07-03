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
use App\Models\Store;
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
      'name' => 'Sabihisma Fatih',
      'username' => 'sabfatiih',
      'email' => 'fatih@gmail.com',
      'email_verified_at' => now(),
      'password' => Hash::make('fatih'),
      'remember_token' => Str::random(10),
      'image_url' => 'user-images/1a89323e9df6fbba533b664239545226.jpg',
      'is_admin' => true,
    ]);

    $users = User::factory(7)->create();
    $allUsers = $users->push($userFatih);

    // 2. Store
    $storeFastore = Store::factory()->create([
      'user_id' => $userFatih->id,
      'name' => 'Official FaStore',
      'image_url' => 'store-images/78b5f2e7f20ae23ab2d5e36191e92ff2.jpg',
      'is_active' => true,
    ]);

    $stores = [$storeFastore];
    foreach ($users as $user) {
      if(rand(0,1)){
        $stores[] = Store::factory()->create([
          'user_id' => $user->id,
          'name' => $user->name . "'s Store"
        ]);
      }
    }

    // 3. Buat categories custom (7 kategori umum)
    $categoryNames = ['Clothes', 'Furniture', 'Electronics', 'Books', 'Toys', 'Foods', 'Beauty'];
    $categories = collect();
    foreach ($categoryNames as $name) {
      $categories->push(Category::factory()->create(['name' => $name, 'slug' => Str::slug($name)]));
    }

    // 4. Buat products dgn store_id-nya dan attach ke categories
    $products = Product::factory(40)->create([
      'store_id' => $stores[array_rand($stores)]
    ]);
    $products->each(function ($product) use ($categories) {
      $product->categories()->attach(
        $categories->random(rand(1, 3))->pluck('id')->toArray()
      );
    });
    

    // 5. Product images (1-4 gambar per product)

    $imageFiles = [
        'product-images/74d32ac83b5436d8e5b896f61ae3fc66.jpg',
        'product-images/c737ec114a2f2acbbb85f5bea66f9643.jpg',
        'product-images/5c3dcae7fad881836c5139badc35c078.jpg',
        'product-images/99292b3e2f965ff787c2f9e6cca0839c.jpg',
        'product-images/eb6c61980424dfb3d91943394806f156.jpg',
        'product-images/98469ffeef6c977c3e508597350b1456.jpg',
        'product-images/6b66c35390ef24150631003a6c9f7da2.jpg',
        'product-images/337cf1349b857d233cb8e4f787717208.jpg',
        'product-images/6283c4d0654cad00c678047aeea56f54.jpg',
        'product-images/a2de8f121e3385fc9419ee51a8d519c9.jpg',
        'product-images/c7e3d41447ab9c5670a572cfb7444039.jpg',
        'product-images/a8c491cb84540956db25665864c6fe13.jpg',
        'product-images/8533b9c08a136157aca1a2042d6e766f.jpg',
        'product-images/857b0c6e50b418b898a193dc45241e86.jpg',
        'product-images/2a7de063594975eb7930e878f5430972.jpg',
        'product-images/a978490cc9982566748e472d568e1f92.jpg',
        'product-images/59e579d2afddc161343a79ec3be536da.jpg',
        'product-images/1219846610bec8fb9ead88a982db84a8.jpg',
        'product-images/b17a540da8bb0337a302bafa28def9e5.jpg',
        'product-images/710e67aab38cbba94f1efa24a1d78d81.jpg',
        'product-images/450028303530a1f0b7b3c1286ef36ba5.jpg',
        'product-images/4e747fc54b2b48f8b2dd4c4049cc8b15.jpg',
        'product-images/68c63379347c3c776239a6c295d33a8f.jpg',
        'product-images/d3949d62c0f6c6c43ab3098fabc54570.jpg',
        'product-images/63b197877fbd179fc533e33be0ea3557.jpg',
        'product-images/6824225874abbe65338958bacd537405.jpg',
        'product-images/2d210a2d0cef7d1434fa852708056393.jpg',
        'product-images/54768f10f262261baebee5aca63879d2.jpg',
        'product-images/adfcfb7847b6e5b2700b26317532bfad.jpg',
        'product-images/c6655dcfc098bcef046d9713316122bb.jpg',
        'product-images/a07adcc44310f00c9dd6fae4ad5af98c.jpg',
        'product-images/713d7da4b01a75254fed33f6568f6c33.jpg',
        'product-images/98469ffeef6c977c3e508597350b1456.jpg',
        'product-images/2a7de063594975eb7930e878f5430972.jpg',
        'product-images/1a89323e9df6fbba533b664239545226.jpg',
        'product-images/a978490cc9982566748e472d568e1f92.jpg',
        'product-images/79931f02153be685094f6a1ac9b16a2e.jpg',
        'product-images/710e67aab38cbba94f1efa24a1d78d81.jpg',
        'product-images/9a1594d4067e45ba0e5c1b472eb12017.jpg',
        'product-images/55fe4e4be9be803189e324c346718473.jpg',
        'product-images/4350a735510dd1849284ed4c3aa9b585.jpg',
        'product-images/e9a0903348e5513ccb8d360a9a688d44.jpg',
        'product-images/be42943f0b2045ce4992033e6217ed4f.jpg',
    ];

    shuffle($imageFiles);

    foreach($products as $i => $product){
      $image_url = array_pop($imageFiles);
  
      ProductImage::create([
        'product_id' => $product->id, 
        'image_url' => $image_url,
        'thumb_url' => str_replace('product-images', 'product-thumbs',$image_url),
        'is_primary' => true,
      ]);
      ProductImage::factory(rand(0, 3))->create([
        'product_id' => $product->id,
      ]);
    }

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
