<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Http\Request;

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
      $user = auth('web')->user();
      $wishlist = Wishlist::firstOrCreate([
          'user_id' => $user->id,
          'name' => 'Wishlist #1'
      ]);

      $product_id = $request->input('product_id');

      WishlistItem::create([
        "wishlist_id" => $wishlist->id,
        "product_id" => $product_id,
      ]);

      return redirect("product")->with("success", "Product successfully added to wishlist");
    }

    /**
     * Display the specified resource.
     */
    public function show(Wishlist $wishlist)
    { 
      return view('components.profile.wishlist', ["wishlistItems" => WishlistItem::with('product.categories')->where('wishlist_id', '=', $wishlist->id)->get()]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    { 
      $wishlist->delete();

      return redirect("wishlist")->with("success", "Wishlist deleted successfully");
    }

    public function itemDestroy(WishlistItem $wishlistItem){
      $wishlistItem->delete();

      return back()->with("success", "Product successfully deleted from wishlist");
    }
}
