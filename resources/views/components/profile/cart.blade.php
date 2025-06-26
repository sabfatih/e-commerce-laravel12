<x-layouts.starter>
  <main class="container bg-gradient-to-br from-violet-50 to-violet-100 mx-auto min-h-screen px-8 py-6">
    <a href="{{ route('home') }}">Back to homepage</a>


    @foreach ($cartItems as $cartItem)
      <div class="w-7/12 h-32 rounded-md px-6 py-3.5 bg-zinc-200 flex gap-x-2">
        <div class="h-full aspect-square bg-sky-400 rounded-lg"></div>
        <div class="grow">
          <h1 class="text-xl">{{ $cartItem->product->name }}</h1>
            <p>Categories: {{ implode(', ', $cartItem->product->categories->pluck('name')->toArray()) }}</p>
        </div>
        <div class="flex flex-col justify-between">
          <span class="text-center text-lg">${{ $cartItem->product->price }}</span>

          <div class="flex gap-x-4">
            <form action="{{ route('cartItem.destroy',  $cartItem->id ) }}" method="POST" class="flex">
              @csrf
              @method('DELETE')
              <button class="cursor-pointer my-auto">
                <i class="fa-solid fa-trash text-xl text-red-500"></i>
              </button>
            </form>
              
            <form x-data="{'quantity': {{ $cartItem->quantity }}}" id="quantity-form" action="{{ route('cartItem.update', $cartItem->id) }}" method="POST" class="w-fit h-10 bg-teal-300 rounded-full text-xl flex justify-between items-center gap-x-2 px-2 py-1">
              <button type="button" onclick="updateQuantity(event)" x-on:click="quantity--" 
              :class="quantity == 1 ? '' : 'cursor-pointer'" 
              :disabled="quantity == 1">
                <i class="fa-solid fa-minus" :class="quantity == 1 ? 'opacity-25' : ''"></i>
              </button>
              @csrf
              @method('PATCH')
              <input 
              x-model="quantity" 
              @keydown="
                if (['e', '-', '+'].includes($event.key)) {
                  $event.preventDefault()
                }
              "
              x-on:input="
                if(isNaN($event.target.value) || $event.target.value < 1){
                  value = 1;
                  quantity = 1;
                }
                if($event.target.value > 99){
                  value = 99;
                  quantity = 99;
                }
              "
              @paste.prevent
              type="number" name="quantity" id="quantity-cart-item" 
              min="1" max="99" 
              class="w-12 bg-transparent border-none focus:ring-0"
              />
              <button type="button" onclick="updateQuantity(event)" :disabled="quantity == 99" :class="quantity == 99 ? 'opacity-25' : 'cursor-pointer'" x-on:click="quantity++">
                <i class="fa-solid fa-plus"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    @endforeach

  </main>

  <script>
    let debounceTimer;
    const updateQuantity = (e) => {
      clearTimeout(debounceTimer);
      debounceTimer = setTimeout(() => {
        e.target.closest('form').submit();
      }, 500);
    }

  </script>
</x-layouts.starter>