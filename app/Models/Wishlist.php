<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    /** @use HasFactory<\Database\Factories\WishlistFactory> */
    use HasFactory;

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function items(){
      return $this->hasMany(WishlistItem::class);
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
