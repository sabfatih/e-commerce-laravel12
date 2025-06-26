<x-layouts.starter>
  <main class="container bg-gradient-to-br from-violet-50 to-violet-100 mx-auto min-h-screen px-8 py-6">
    <a href="{{ route('wishlist.index') }}">Back to wishlists</a>


    @foreach ($wishlistItems as $wishlistItem)
      <div x-data="{moveItem: false}">
        <div class="w-7/12 h-32 rounded-md px-6 py-3.5 bg-zinc-200 flex gap-x-2">
          <div class="h-full aspect-square bg-sky-400 rounded-lg"></div>
          <div class="grow">
            <h1 class="text-xl">{{ $wishlistItem->product->name }}</h1>
              <p>Categories: {{ implode(', ', $wishlistItem->product->categories->pluck('name')->toArray()) }}</p>
          </div>
          <div class="flex flex-col justify-between">
            <span class="text-center text-lg">${{ $wishlistItem->product->price }}</span>

            <div class="flex gap-2 justify-end">
              <button x-on:click="moveItem = !moveItem" class="cursor-pointer my-auto">
                <i class="fa-solid fa-arrow-up-right-from-square text-xl text-emerald-500"></i>
              </button>
              <form action="{{ route('wishlist.itemDestroy', $wishlistItem->id) }}" method="POST" class="flex self-end">
                @csrf
                @method('DELETE')
                <button class="cursor-pointer my-auto">
                  <i class="fa-solid fa-trash text-xl text-red-500"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
        <form x-show="moveItem" action="{{ route('wishlist.itemUpdate', $wishlistItem->id) }}" method="POST">
          @csrf
          @method('PATCH')
          @foreach ($wishlists as $wishlist)
            <label>
              <input type="radio" name="wishlist-id" id="wishlist-id" value="{{ $wishlist->id }}" @checked($wishlist->id == $wishlistItem->wishlist_id)>
              <span>{{ $wishlist->name }}</span>
            </label>
          @endforeach
          <button type="submit" class="cursor-pointer block bg-primary-400 rounded-md py-1.5 px-2.5 ">Save</button>
        </form>
      </div>
    @endforeach

  </main>
</x-layouts.starter>