<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WishlistItem extends Model
{
    /** @use HasFactory<\Database\Factories\WishlistItemFactory> */
    use HasFactory;

    public function wishlist(){
      return $this->belongsTo(Wishlist::class);
    }

    public function product(){
      return $this->belongsTo(Product::class);
    }

    protected $keyType = 'string';
    public $incrementing = false;

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
