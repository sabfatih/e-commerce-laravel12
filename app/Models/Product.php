<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected static function boot()
    {

      parent::boot();

      static::creating(function($model){
        // dd($model);
        if (!$model->getKey()) {
          $model->{$model->getKeyName()} = (string) Str::uuid();
        }
      });
    }
}
