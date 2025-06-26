<x-layouts.starter>
  <main class="container bg-gradient-to-br from-violet-50 to-violet-100 mx-auto min-h-screen px-8 py-6">
    <a href="{{ route('home') }}">Back to homepage</a>

    <div x-data="{newWishlist: false}">
      <button x-on:click="newWishlist = !newWishlist" class="bg-teal-400 block rounded-md py-2 px-3 my-3 cursor-pointer">New wishlist</button>
      <form x-show="newWishlist" action="{{ route('wishlist.store') }}" method="POST" class="mb-4">
        @csrf
        <label>
          <p>Name</p> 
          <input type="text" id="name" name="name">
        </label>
        <button type="submit" class="bg-primary-400 rounded-md py-1.5 px-2 cursor-pointer">Create</button>
      </form>
    </div>
    <div class="grid grid-cols-5 grid-rows-4 gap-x-4 gap-y-6">
      @foreach ($wishlists as $wishlist)
      <div>
        <a href="{{ route('wishlist.show', $wishlist->id) }}">
          <div class="w-full h-64 rounded-md bg-zinc-200">
            <img src="https://picsum.photos/id/15/200/300" alt="example img" class="object-cover w-full rounded-t-md h-9/12">
            <div class="px-6 py-3.5 flex justify-between">
              <h3>{{ $wishlist->name }}</h3>

            </div>
          </div>
        </a>
        <div x-data="{rename: false, currentName: `{{$wishlist->name}}`}" >
          <div class="flex gap-2 py-1.5 px-2">
            <button x-on:click="rename = !rename" class="cursor-pointer my-auto">
              <i class="fa-solid fa-pencil text-xl text-teal-500"></i>
            </button>
            <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST" class="flex self-end">
              @csrf
              @method('DELETE')
              <button class="cursor-pointer my-auto">
                <i class="fa-solid fa-trash text-xl text-red-500"></i>
              </button>
            </form>
          </div>

          <form x-show="rename" action="{{ route('wishlist.update', $wishlist->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <label>
              <p>Name</p> 
              <input type="text" id="name" name="name" :value="currentName">
            </label>
            <button type="submit" class="bg-primary-400 rounded-md py-1.5 px-2 cursor-pointer">Rename</button>
          </form>
        </div>
      </div>
      @endforeach
    </div>


  </main>
</x-layouts.starter>