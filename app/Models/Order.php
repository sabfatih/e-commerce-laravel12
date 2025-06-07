<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;


    public function users(){
      return $this->belongsTo(User::class);
    }

    public function items(){
      return $this->belongsTo(OrderItem::class);
    }

    public function payments(){
      return $this->hasOne(Payment::class);
    }

    protected $keyType = 'string';    // supaya Laravel tahu tipe primary key-nya string (UUID)
    public $incrementing = false;     // supaya Laravel gak expect auto increment integer
}
