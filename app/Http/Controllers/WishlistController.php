<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $user = auth('web')->user();
      
      return view('components.profile.wishlists', ["wishlists" => Wishlist::where('user_id', '=', $user->id)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $request->validate([
        'name' => ['required', 'max:255'],
      ]);

      $user = auth('web')->user();
      Wishlist::create([
        'user_id' => $user->id,
        'name' => $request->input('name')
      ]);

      return redirect("wishlist")->with("success", "Wishlist successfully created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Wishlist $wishlist)
    { 
      $user = auth('web')->user();
      
      return view('components.profile.wishlist', [
        "wishlistItems" => WishlistItem::with('product.categories')->where('wishlist_id', '=', $wishlist->id)->get(), 
        "wishlists" => Wishlist::where('user_id', '=', $user->id)->get()
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wishlist $wishlist)
    {
      $request->validate([
        'name' => ['required', 'max:255'],
      ]);

      $wishlist->update([
        'name' => $request->input('name')
      ]);

      return redirect("wishlist")->with("success", "Wishlist's name successfully changed");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    { 
      $wishlist->delete();

      return redirect("wishlist")->with("success", "Wishlist deleted successfully");
    }

    public function itemStore($productId)
    {
      $user = auth('web')->user();
      $wishlist = Wishlist::firstOrCreate([
        'user_id' => $user->id,
      ],
      [ 
        'name' => $user->name . "'s 1st wishlist"
      ]);

      WishlistItem::create([
        "wishlist_id" => $wishlist->id,
        "product_id" => $productId,
      ]);

      return redirect("product")->with("success", "Product successfully added to wishlist");
    }

    public function itemUpdate(Request $request, WishlistItem $wishlistItem){
      $wishlistItem->update([
        'wishlist_id' => $request->input('wishlist-id')
      ]);

      return back()->with("success", "Product successfully moved");
    }

    public function itemDestroy(WishlistItem $wishlistItem){
      $wishlistItem->delete();

      return back()->with("success", "Product successfully deleted from wishlist");
    }
}
