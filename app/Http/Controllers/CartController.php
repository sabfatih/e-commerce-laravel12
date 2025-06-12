<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //

    public function index(){
      $user = auth('web')->user();

      return view("components.profile.cart", ["cartItems" => CartItem::with('product.categories')->where("user_id", "=", $user->id)->get()]);
    }


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

      return redirect("product")->with("success", "Product successfully added to cart");
    }

    public function itemDestroy(CartItem $cartItem){
      $cartItem->delete();

      return back()->with("success", "Product successfully deleted from cart");
    }
}
