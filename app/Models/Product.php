<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    public function categories(){
      return $this->belongsToMany(Category::class);
    }

    public function images(){
      return $this->hasMany(ProductImage::class);
    }

    public function cartItems(){
      return $this->hasMany(CartItem::class);
    }

    public function orderItems(){
      return $this->hasMany(OrderItem::class);
    }
    
    public function wishlistItems(){
      return $this->hasMany(WishlistItem::class);
    }

    protected $keyType = 'string';    // supaya Laravel tahu tipe primary key-nya string (UUID)
    public $incrementing = false;     // supaya Laravel gak expect auto increment integer
}
