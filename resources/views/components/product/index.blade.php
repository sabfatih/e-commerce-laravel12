<x-layouts.starter>
  <main class="px-4 py-3">
    <a href="{{ route('home') }}">Back to homepage</a>
    <div class="flex flex-wrap mt-24 gap-x-4 gap-y-6 justify-evenly">

      @foreach ($products as $product)
        <div class="w-36 h-48 bg-sky-500 rounded-md space-y-1">  
          <img src="https://picsum.photos/id/1/200/300" alt="example image" class="w-full h-7/12 rounded-t-md object-cover">
          <div class="w-full px-2 py-1.5">
            <h3 class="text-base">{{ Str::limit($product->name, 10) }}</h3>
            <p class="text-sm">{{ $product->price }}</p>
            <div class="flex justify-between mt-1">
              @if (in_array($product->id, $wishlistedProductIdByCurrentUser))
                <form action="{{ route('wishlist.itemDestroy', array_keys($wishlistedProductIdByCurrentUser, $product->id)) }}" method="POST">
                  @csrf
                  @method("DELETE")
                  <button type="submit" class="cursor-pointer">
                    <i class="fa-solid fa-heart"></i>
                  </button>
                </form>
              @else
                <form action="{{ route('wishlist.itemStore', $product->id) }}" method="POST">
                  @csrf
                  <input type="hidden" name="product-id" id="product-id" value="">
                  <button type="submit" class="cursor-pointer">
                    <i class="fa-regular fa-heart"></i>
                  </button>
                </form>
              @endif

              <form action="{{ route('cartItem.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                <button class="cursor-pointer">
                  <i class="fa-solid fa-cart-shopping"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </main>
</x-layouts.starter>