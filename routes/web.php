<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;

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
  Route::resource('/product', ProductController::class)->middleware(isAdmin::class);
  Route::resource('/wishlist', WishlistController::class);
  Route::delete('/wishlist/item/{wishlistItem}', [WishlistController::class, 'itemDestroy'])->name('wishlist.itemDestroy');

  Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
  Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
  Route::delete('/cart', [CartController::class, 'destroy'])->name('cart.destroy');
  Route::delete('/cart/item/{cartItem}', [CartController::class, 'itemDestroy'])->name('cart.itemDestroy');
});


require __DIR__.'/auth.php';
