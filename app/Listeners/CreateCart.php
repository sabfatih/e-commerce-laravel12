<?php

namespace App\Listeners;

use App\Models\Cart;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateCart
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
      $newCart = Cart::create([
        'user_id' => $event->user->id,
      ]);
    }
}
