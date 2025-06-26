<?php

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartItemController;

use App\Http\Controllers\WishlistController;
use App\Http\Controllers\WishlistItemController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
  Route::resource('product', ProductController::class)->middleware(isAdmin::class);
  Route::get('/api/product', function(Request $request){
    $categories = $request->categories;
    $products = Product::wherehas('categories', function($query) use ($categories) {
      $query->whereIn('id', $categories);
    })->get();
    
    return $products;
  });


  Route::resource('cart', CartItemController::class)->parameters(['cart' => 'cartItem'])->names('cartItem');
  Route::resource('wishlist', WishlistController::class);
  Route::post('/wishlist/item/{productId}', [WishlistController::class, 'itemStore'])->name('wishlist.itemStore');
  Route::patch('/wishlist/item/{wishlistItem}', [WishlistController::class, 'itemUpdate'])->name('wishlist.itemUpdate');
  Route::delete('/wishlist/item/{wishlistItem}', [WishlistController::class, 'itemDestroy'])->name('wishlist.itemDestroy');
});


require __DIR__.'/auth.php';
