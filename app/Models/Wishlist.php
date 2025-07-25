<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    /** @use HasFactory<\Database\Factories\WishlistFactory> */
    use HasFactory, Sluggable;

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function items(){
      return $this->hasMany(WishlistItem::class);
    }

    protected $fillable = [
      'user_id',
      'name',
    ];

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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'unique' => true,
                'uniqueWith' => ['user_id'],
            ]
        ];
    }
}
