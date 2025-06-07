<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    /** @use HasFactory<\Database\Factories\ProductImageFactory> */
    use HasFactory;

    public function product(){
      return $this->belongsTo(Product::class);
    }

    protected $keyType = 'string';    // supaya Laravel tahu tipe primary key-nya string (UUID)
    public $incrementing = false;     // supaya Laravel gak expect auto increment integer
}
