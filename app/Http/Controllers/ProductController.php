<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\WishlistItem;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $user = auth('web')->user();

      $products = Product::all();

      $productImages = ProductImage::where('is_primary', true)->pluck('image_url','product_id')->map(fn($url) => str_replace('product-images/', '', $url));

      // dd($productImages->toArray());

      $wishlistedProductIdByCurrentUser = WishlistItem::whereHas('wishlist', function($query) use ($user) {
        $query->where('user_id', '=', $user->id);
      })->pluck('product_id','id')->toArray();
      
      return view('components.product.index', [
        "products" => $products, 
        "productImages" => $productImages,
        "wishlistedProductIdByCurrentUser" => $wishlistedProductIdByCurrentUser]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('components.product.add-product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //   $imagesPath = Storage::disk('public')->files('product-images');

    // // dd($imagesPath);

    // foreach($imagesPath as $imagePath){
    //   $rawImage = Storage::disk('public')->get($imagePath);
    //   $fileName = pathinfo($imagePath, PATHINFO_FILENAME);
    //   $extName = pathinfo($imagePath, PATHINFO_EXTENSION);
    //   $image = Image::read($rawImage)->scale(width:300);

    //   Storage::disk('public')->put(
    //       'product-thumbs/' . $fileName . '.' . $extName,
    //       $image->encodeByExtension($extName, quality: 70)
    //   );
    // }

      $validatedData = $request->validate([
        "name" => ["required"],
        "description" => ["nullable"],
        "price" => ["required","integer", "min:0.001"],
        "stock" => ["required", "numeric"],
        "weight" => ["required","integer", "min:0.000001"],
        "images.*" => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120']
      ]);

      $product = Product::create([
        "name" => $validatedData["name"],
        "description" => $validatedData["description"],
        "price" => $validatedData["price"],
        "stock" => $validatedData["stock"],
        "weight" => $validatedData["weight"],
      ]);
      
      if ($request->hasFile("images")) {
        $images = $request->file("images");
        $primaryImageIndex = $request->input('isPrimaryRadio') || "0";
        foreach ($images as $index => $image) {
          ProductImage::create([
            "product_id" => $product->id,
            "image_url" => $image->store("products", "public"),
            'is_primary' => $primaryImageIndex == $index
          ]);
        }
      }

      return redirect("dashboard")->with("success", "Product created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

      $user = auth('web')->user();
      
      $wishlistedProductIdByCurrentUser = WishlistItem::whereHas('wishlist', function ($query) use ($user) {
        $query->where('user_id', '=', $user->id);
      })->pluck('product_id', 'id')->toArray();

      return view('components.product.detail', [
        "product" => $product,
        'wishlistedProductIdByCurrentUser' => $wishlistedProductIdByCurrentUser
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
