<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('components.add-product.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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
        //
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
