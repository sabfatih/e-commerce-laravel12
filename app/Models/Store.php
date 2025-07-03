<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
  use HasFactory;
  
  protected $guarded = [
      'id'
  ];

  protected $keyType = 'string';
  public $incrementing = false;

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function products(){
    return $this->hasMany(Product::class);
  }

  protected static function boot(){
    parent::boot();

      static::creating(function($model){
        // dd($model);
        if (!$model->getKey()) {
          $model->{$model->getKeyName()} = (string) Str::uuid();
        }
      });
  }
}
