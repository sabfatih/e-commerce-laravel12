<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
