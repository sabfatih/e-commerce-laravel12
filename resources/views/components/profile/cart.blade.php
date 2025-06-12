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
            <form action="{{ route('cart.itemDestroy',  $cartItem->id ) }}" method="POST" class="flex">
              @csrf
              @method('DELETE')
              <button class="cursor-pointer my-auto">
                <i class="fa-solid fa-trash text-xl text-red-500"></i>
              </button>
            </form>
            <div x-data="{'quantity': {{ $cartItem->quantity }}}" class="w-fit h-10 bg-teal-300 rounded-full text-xl flex justify-between items-center gap-x-2 px-2 py-1">
              <button x-on:click="quantity--" 
              :class="quantity == 1 ? '' : 'cursor-pointer'" 
              :disabled="quantity == 1">
                <i class="fa-solid fa-minus" :class="quantity == 1 ? 'opacity-25' : ''"></i>
              </button>
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
              "
              @paste.prevent
              type="number" name="quantity" id="quantity-cart-item" 
              min="1" max="1000000" 
              class="w-12 bg-transparent border-none focus:ring-0"/>
              <button x-on:click="quantity++" class="cursor-pointer">
                <i class="fa-solid fa-plus"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    @endforeach

  </main>
</x-layouts.starter>