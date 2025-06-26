<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
      $user = auth('web')->user();

      return view("components.profile.cart", ["cartItems" => CartItem::with('product.categories')->where("user_id", "=", $user->id)->latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
      $user = auth('web')->user();
      $product_id = $request->input('product_id');

      $cartItem = CartItem::firstOrCreate([
        "user_id" => $user->id,
        "product_id" => $product_id
      ],
      [
        "quantity" => 1
      ]); 

      if(!$cartItem->wasRecentlyCreated){
        $cartItem->increment('quantity');
      }

      return back()->with("success", "Product successfully added to cart");
    }

    /**
     * Display the specified resource.
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartItem $cartItem)
    {
      $request->validate([
        'quantity' => ['required', 'integer', 'min:1', 'max:99']
      ]);

      // dd($request->input('quantity'));
      // dd($cartItem);

      $cartItem->update([
        'quantity' => $request->input('quantity')
      ]);

      return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItem $cartItem)
    {
      $cartItem->delete();

      return back()->with("success", "Product successfully deleted from cart");
    }
}
