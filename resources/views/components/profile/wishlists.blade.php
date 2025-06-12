<x-layouts.starter>
  <main class="container bg-gradient-to-br from-violet-50 to-violet-100 mx-auto min-h-screen px-8 py-6">
    <a href="{{ route('home') }}">Back to homepage</a>
    <div class="grid grid-cols-5 grid-rows-4 gap-x-4 gap-y-6">
      @foreach ($wishlists as $wishlist)
        <a href="{{ route('wishlist.show', $wishlist->id) }}">
          <div class="w-full h-64 rounded-md bg-zinc-200">
            <img src="https://picsum.photos/id/15/200/300" alt="example img" class="object-cover w-full rounded-t-md h-9/12">
            <div class="px-6 py-3.5 flex justify-between">
              <h3>{{ $wishlist->name }}</h3>

            </div>
          </div>
        </a>
        <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST" class="flex self-end">
          @csrf
          @method('DELETE')
          <button class="cursor-pointer my-auto">
            <i class="fa-solid fa-trash text-xl text-red-500"></i>
          </button>
        </form>
      @endforeach
    </div>


  </main>
</x-layouts.starter>