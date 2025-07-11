<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, Sluggable;

    public function products() {
      return $this->belongsToMany(Product::class);
    }

    protected $fillable = [
      "name",
      "description"
    ];

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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
