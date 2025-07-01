<nav
x-data="{
  openQuickCart: false,
}" 
class="bg-white text-gray-800 shadow-sm py-3 md:py-4 sticky top-0 z-40">
  <div class="container mx-auto px-4 flex gap-x-4 md:gap-x-8 w-full">
      <a href="{{ route('home') }}" class="items-center hidden md:flex">
          <h1 class="text-xl font-bold text-gray-800">FaStore</h1>
      </a>
      <div x-data="{searchQuery: ''}" class="grow flex gap-x-2">
        <input 
        x-on:keydown.enter="window.location.href= `/search?q=${encodeURIComponent(searchQuery)}`"
        x-model="searchQuery"
        type="text" class="w-full text-sm max-w-lg border-none rounded-lg ring-1 focus:ring-2 ring-black/20 focus:ring-primary-400 transition-all shadow focus:shadow-md peer" placeholder="Search for products">
      </div>
      <div class="hidden gap-x-6 md:flex">
          <div class="items-center gap-x-4 hidden md:flex">
            @auth
            @if (Route::is('home'))
            <button x-on:click="openQuickCart = true" class="text-gray-600 hover:text-gray-900 cursor-pointer">
              <i class="fas fa-shopping-bag"></i>
            </button>
            @else
            <a href="{{ route('cartItem.index') }}" class="text-gray-600 hover:text-gray-900 cursor-pointer">
              <i class="fas fa-shopping-bag"></i>
            </a>
            @endif
            @endauth
            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 cursor-pointer">
              <i class="fas fa-user"></i>
            </a>
          </div>
        </div>
        <div class="flex justify-center items-center">
          <a href="{{ route('cartItem.index') }}" class="md:hidden text-gray-600 hover:text-gray-900">
            <i class="fas fa-shopping-bag text-lg"></i>
          </a>
        </div>
  </div>
  



  {{-- <div x-on:click="openQuickCart = !openQuickCart;console.log('Cart:', openQuickCart);" x-bind:class="openQuickCart ? 'text-red-200' : 'text-purple-400'" class="fixed top-1/2 left-1/2 size-16 rounded-md bg-sky-400">
    sss
  </div> --}}






  <aside 
  x-cloak
  x-on:click.outside="openQuickCart = false" 
  x-show="openQuickCart"
  x-transition:enter="transition duration-300"
  x-transition:enter-start="translate-x-full"
  x-transition:enter-end="translate-x-0"
  x-transition:leave="transition duration-300"
  x-transition:leave-start="translate-x-0"
  x-transition:leave-end="translate-x-full"
  class="fixed top-0 right-0 w-80 z-50 h-dvh rounded-l-sm shadow-xl font-dm transform transition-transform duration-300 bg-white flex flex-col">
    <header class="flex justify-between items-center px-5 py-2.5 border-b border-black/10">
      <h1 class="text-xl font-semibold">Your Cart</h1>
      <button x-on:click="openQuickCart = false" class="flex cursor-pointer">
        <i class="fas fa-xmark text-2xl text-gray-900 m-auto"></i>
      </button>
    </header>

    <section class="max-w-full overflow-y-scroll px-4 py-2.5 grow space-y-4">
      <div>
        <h2 class="text-black font-semibold">
          <i class="fas fa-store"></i>
          Official Rune Parker
        </h2>
        <div class="divide-y-1 divide-black/10">
          <div class="flex h-24 py-2.5 px-2 gap-x-2.5">
            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1598&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="White Watch" 
            class="h-full aspect-square rounded-md object-cover outline outline-black/10">
            <div class="flex flex-col grow">
              <div class="">
                <h3 class="text-base whitespace-nowrap">{{ Str::limit('White Smartwatch', 20, '...') }}</h3>
                <h4 class="text-sm text-gray-700 font-semibold tracking-wide">$199.99</h4>
              </div>
      
              <div 
                x-data="{
                  qty: 1,
                  minOrder: 1,
                  maxOrder: 999,
                  decrement(){
                    if(this.qty > this.minOrder){
                      this.qty--;
                    }
                  },
                  increment(){
                    if(this.qty < this.maxOrder){
                      this.qty++;
                    }
                  },
      
                }" class="space-y-1 col-start-3 mt-auto">
                <div class="flex justify-end">
                  <button x-on:click="decrement();" :disabled="qty <= minOrder" class="flex cursor-pointer disabled:cursor-default p-1.5 rounded-l-full border border-black/20 border-r-0 disabled:text-gray-300 transition-all">
                    <i class="fas fa-minus m-auto text-sm"></i>
                  </button>
                  <div>
                    <input :value="qty" x-on:change="qty = event.target.value" x-on:input="qty = sanitazeNumber(event.target, minOrder, maxOrder)" min="0" max="999" step="1" type="number" name="quantity" id="quantity-cart-item" class="border-y border-x-0 border-black/20 w-10 h-8 text-center p-0 self-end my-auto text-sm focus:ring-0" autocomplete="off">
                  </div>
                  <button x-on:click="increment();" :disabled="qty >= maxOrder" class="flex cursor-pointer disabled:cursor-default p-1.5 rounded-r-full border border-black/20 border-l-0 disabled:text-gray-300 transition-all">
                    <i class="fas fa-plus m-auto text-sm"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="flex h-24 py-2.5 px-2 gap-x-2.5">
            <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?q=80&w=1064&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Black Watch" 
            class="h-full aspect-square rounded-md object-cover outline outline-black/10">
            <div class="flex flex-col grow">
              <div class="">
                <h3 class="text-base whitespace-nowrap">{{ Str::limit('Black Smartwatch', 20, '...') }}</h3>
                <h4 class="text-sm text-gray-700 font-semibold tracking-wide">$249.99</h4>
              </div>
      
              <div 
                x-data="{
                  qty: 1,
                  minOrder: 1,
                  maxOrder: 400,
                  decrement(){
                    if(this.qty > this.minOrder){
                      this.qty--;
                    }
                  },
                  increment(){
                    if(this.qty < this.maxOrder){
                      this.qty++;
                    }
                  },
      
                }" class="space-y-1 col-start-3 mt-auto">
                <div class="flex justify-end">
                  <button x-on:click="decrement();" :disabled="qty <= minOrder" class="flex cursor-pointer disabled:cursor-default p-1.5 rounded-l-full border border-black/20 border-r-0 disabled:text-gray-300 transition-all">
                    <i class="fas fa-minus m-auto text-sm"></i>
                  </button>
                  <div>
                    <input :value="qty" x-on:change="qty = event.target.value" x-on:input="qty = sanitazeNumber(event.target, minOrder, maxOrder)" min="0" max="999" step="1" type="number" name="quantity" id="quantity-cart-item" class="border-y border-x-0 border-black/20 w-10 h-8 text-center p-0 self-end my-auto text-sm focus:ring-0" autocomplete="off">
                  </div>
                  <button x-on:click="increment();" :disabled="qty >= maxOrder" class="flex cursor-pointer disabled:cursor-default p-1.5 rounded-r-full border border-black/20 border-l-0 disabled:text-gray-300 transition-all">
                    <i class="fas fa-plus m-auto text-sm"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <h2 class="text-black font-semibold">
          <i class="fas fa-store"></i>
          Official Rune Parker
        </h2>
        <div class="divide-y-1 divide-black/10">
          <div class="flex h-24 py-2.5 px-2 gap-x-2.5">
            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1598&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="White Watch" 
            class="h-full aspect-square rounded-md object-cover outline outline-black/10">
            <div class="flex flex-col grow">
              <div class="">
                <h3 class="text-base whitespace-nowrap">{{ Str::limit('White Smartwatch', 20, '...') }}</h3>
                <h4 class="text-sm text-gray-700 font-semibold tracking-wide">$199.99</h4>
              </div>
      
              <div 
                x-data="{
                  qty: 1,
                  minOrder: 1,
                  maxOrder: 999,
                  decrement(){
                    if(this.qty > this.minOrder){
                      this.qty--;
                    }
                  },
                  increment(){
                    if(this.qty < this.maxOrder){
                      this.qty++;
                    }
                  },
      
                }" class="space-y-1 col-start-3 mt-auto">
                <div class="flex justify-end">
                  <button x-on:click="decrement();" :disabled="qty <= minOrder" class="flex cursor-pointer disabled:cursor-default p-1.5 rounded-l-full border border-black/20 border-r-0 disabled:text-gray-300 transition-all">
                    <i class="fas fa-minus m-auto text-sm"></i>
                  </button>
                  <div>
                    <input :value="qty" x-on:change="qty = event.target.value" x-on:input="qty = sanitazeNumber(event.target, minOrder, maxOrder)" min="0" max="999" step="1" type="number" name="quantity" id="quantity-cart-item" class="border-y border-x-0 border-black/20 w-10 h-8 text-center p-0 self-end my-auto text-sm focus:ring-0" autocomplete="off">
                  </div>
                  <button x-on:click="increment();" :disabled="qty >= maxOrder" class="flex cursor-pointer disabled:cursor-default p-1.5 rounded-r-full border border-black/20 border-l-0 disabled:text-gray-300 transition-all">
                    <i class="fas fa-plus m-auto text-sm"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="flex h-24 py-2.5 px-2 gap-x-2.5">
            <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?q=80&w=1064&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Black Watch" 
            class="h-full aspect-square rounded-md object-cover outline outline-black/10">
            <div class="flex flex-col grow">
              <div class="">
                <h3 class="text-base whitespace-nowrap">{{ Str::limit('Black Smartwatch', 20, '...') }}</h3>
                <h4 class="text-sm text-gray-700 font-semibold tracking-wide">$249.99</h4>
              </div>
      
              <div 
                x-data="{
                  qty: 1,
                  minOrder: 1,
                  maxOrder: 400,
                  decrement(){
                    if(this.qty > this.minOrder){
                      this.qty--;
                    }
                  },
                  increment(){
                    if(this.qty < this.maxOrder){
                      this.qty++;
                    }
                  },
      
                }" class="space-y-1 col-start-3 mt-auto">
                <div class="flex justify-end">
                  <button x-on:click="decrement();" :disabled="qty <= minOrder" class="flex cursor-pointer disabled:cursor-default p-1.5 rounded-l-full border border-black/20 border-r-0 disabled:text-gray-300 transition-all">
                    <i class="fas fa-minus m-auto text-sm"></i>
                  </button>
                  <div>
                    <input :value="qty" x-on:change="qty = event.target.value" x-on:input="qty = sanitazeNumber(event.target, minOrder, maxOrder)" min="0" max="999" step="1" type="number" name="quantity" id="quantity-cart-item" class="border-y border-x-0 border-black/20 w-10 h-8 text-center p-0 self-end my-auto text-sm focus:ring-0" autocomplete="off">
                  </div>
                  <button x-on:click="increment();" :disabled="qty >= maxOrder" class="flex cursor-pointer disabled:cursor-default p-1.5 rounded-r-full border border-black/20 border-l-0 disabled:text-gray-300 transition-all">
                    <i class="fas fa-plus m-auto text-sm"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <h2 class="text-black font-semibold">
          <i class="fas fa-store"></i>
          Official Rune Parker
        </h2>
        <div class="divide-y-1 divide-black/10">
          <div class="flex h-24 py-2.5 px-2 gap-x-2.5">
            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1598&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="White Watch" 
            class="h-full aspect-square rounded-md object-cover outline outline-black/10">
            <div class="flex flex-col grow">
              <div class="">
                <h3 class="text-base whitespace-nowrap">{{ Str::limit('White Smartwatch', 20, '...') }}</h3>
                <h4 class="text-sm text-gray-700 font-semibold tracking-wide">$199.99</h4>
              </div>
      
              <div 
                x-data="{
                  qty: 1,
                  minOrder: 1,
                  maxOrder: 999,
                  decrement(){
                    if(this.qty > this.minOrder){
                      this.qty--;
                    }
                  },
                  increment(){
                    if(this.qty < this.maxOrder){
                      this.qty++;
                    }
                  },
      
                }" class="space-y-1 col-start-3 mt-auto">
                <div class="flex justify-end">
                  <button x-on:click="decrement();" :disabled="qty <= minOrder" class="flex cursor-pointer disabled:cursor-default p-1.5 rounded-l-full border border-black/20 border-r-0 disabled:text-gray-300 transition-all">
                    <i class="fas fa-minus m-auto text-sm"></i>
                  </button>
                  <div>
                    <input :value="qty" x-on:change="qty = event.target.value" x-on:input="qty = sanitazeNumber(event.target, minOrder, maxOrder)" min="0" max="999" step="1" type="number" name="quantity" id="quantity-cart-item" class="border-y border-x-0 border-black/20 w-10 h-8 text-center p-0 self-end my-auto text-sm focus:ring-0" autocomplete="off">
                  </div>
                  <button x-on:click="increment();" :disabled="qty >= maxOrder" class="flex cursor-pointer disabled:cursor-default p-1.5 rounded-r-full border border-black/20 border-l-0 disabled:text-gray-300 transition-all">
                    <i class="fas fa-plus m-auto text-sm"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="flex h-24 py-2.5 px-2 gap-x-2.5">
            <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?q=80&w=1064&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Black Watch" 
            class="h-full aspect-square rounded-md object-cover outline outline-black/10">
            <div class="flex flex-col grow">
              <div class="">
                <h3 class="text-base whitespace-nowrap">{{ Str::limit('Black Smartwatch', 20, '...') }}</h3>
                <h4 class="text-sm text-gray-700 font-semibold tracking-wide">$249.99</h4>
              </div>
      
              <div 
                x-data="{
                  qty: 1,
                  minOrder: 1,
                  maxOrder: 400,
                  decrement(){
                    if(this.qty > this.minOrder){
                      this.qty--;
                    }
                  },
                  increment(){
                    if(this.qty < this.maxOrder){
                      this.qty++;
                    }
                  },
      
                }" class="space-y-1 col-start-3 mt-auto">
                <div class="flex justify-end">
                  <button x-on:click="decrement();" :disabled="qty <= minOrder" class="flex cursor-pointer disabled:cursor-default p-1.5 rounded-l-full border border-black/20 border-r-0 disabled:text-gray-300 transition-all">
                    <i class="fas fa-minus m-auto text-sm"></i>
                  </button>
                  <div>
                    <input :value="qty" x-on:change="qty = event.target.value" x-on:input="qty = sanitazeNumber(event.target, minOrder, maxOrder)" min="0" max="999" step="1" type="number" name="quantity" id="quantity-cart-item" class="border-y border-x-0 border-black/20 w-10 h-8 text-center p-0 self-end my-auto text-sm focus:ring-0" autocomplete="off">
                  </div>
                  <button x-on:click="increment();" :disabled="qty >= maxOrder" class="flex cursor-pointer disabled:cursor-default p-1.5 rounded-r-full border border-black/20 border-l-0 disabled:text-gray-300 transition-all">
                    <i class="fas fa-plus m-auto text-sm"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <h2 class="text-black font-semibold">
          <i class="fas fa-store"></i>
          Official Rune Parker
        </h2>
        <div class="divide-y-1 divide-black/10">
          <div class="flex h-24 py-2.5 px-2 gap-x-2.5">
            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1598&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="White Watch" 
            class="h-full aspect-square rounded-md object-cover outline outline-black/10">
            <div class="flex flex-col grow">
              <div class="">
                <h3 class="text-base whitespace-nowrap">{{ Str::limit('White Smartwatch', 20, '...') }}</h3>
                <h4 class="text-sm text-gray-700 font-semibold tracking-wide">$199.99</h4>
              </div>
      
              <div 
                x-data="{
                  qty: 1,
                  minOrder: 1,
                  maxOrder: 999,
                  decrement(){
                    if(this.qty > this.minOrder){
                      this.qty--;
                    }
                  },
                  increment(){
                    if(this.qty < this.maxOrder){
                      this.qty++;
                    }
                  },
      
                }" class="space-y-1 col-start-3 mt-auto">
                <div class="flex justify-end">
                  <button x-on:click="decrement();" :disabled="qty <= minOrder" class="flex cursor-pointer disabled:cursor-default p-1.5 rounded-l-full border border-black/20 border-r-0 disabled:text-gray-300 transition-all">
                    <i class="fas fa-minus m-auto text-sm"></i>
                  </button>
                  <div>
                    <input :value="qty" x-on:change="qty = event.target.value" x-on:input="qty = sanitazeNumber(event.target, minOrder, maxOrder)" min="0" max="999" step="1" type="number" name="quantity" id="quantity-cart-item" class="border-y border-x-0 border-black/20 w-10 h-8 text-center p-0 self-end my-auto text-sm focus:ring-0" autocomplete="off">
                  </div>
                  <button x-on:click="increment();" :disabled="qty >= maxOrder" class="flex cursor-pointer disabled:cursor-default p-1.5 rounded-r-full border border-black/20 border-l-0 disabled:text-gray-300 transition-all">
                    <i class="fas fa-plus m-auto text-sm"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="flex h-24 py-2.5 px-2 gap-x-2.5">
            <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?q=80&w=1064&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Black Watch" 
            class="h-full aspect-square rounded-md object-cover outline outline-black/10">
            <div class="flex flex-col grow">
              <div class="">
                <h3 class="text-base whitespace-nowrap">{{ Str::limit('Black Smartwatch', 20, '...') }}</h3>
                <h4 class="text-sm text-gray-700 font-semibold tracking-wide">$249.99</h4>
              </div>
      
              <div 
                x-data="{
                  qty: 1,
                  minOrder: 1,
                  maxOrder: 400,
                  decrement(){
                    if(this.qty > this.minOrder){
                      this.qty--;
                    }
                  },
                  increment(){
                    if(this.qty < this.maxOrder){
                      this.qty++;
                    }
                  },
      
                }" class="space-y-1 col-start-3 mt-auto">
                <div class="flex justify-end">
                  <button x-on:click="decrement();" :disabled="qty <= minOrder" class="flex cursor-pointer disabled:cursor-default p-1.5 rounded-l-full border border-black/20 border-r-0 disabled:text-gray-300 transition-all">
                    <i class="fas fa-minus m-auto text-sm"></i>
                  </button>
                  <div>
                    <input :value="qty" x-on:change="qty = event.target.value" x-on:input="qty = sanitazeNumber(event.target, minOrder, maxOrder)" min="0" max="999" step="1" type="number" name="quantity" id="quantity-cart-item" class="border-y border-x-0 border-black/20 w-10 h-8 text-center p-0 self-end my-auto text-sm focus:ring-0" autocomplete="off">
                  </div>
                  <button x-on:click="increment();" :disabled="qty >= maxOrder" class="flex cursor-pointer disabled:cursor-default p-1.5 rounded-r-full border border-black/20 border-l-0 disabled:text-gray-300 transition-all">
                    <i class="fas fa-plus m-auto text-sm"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>

    <footer class="w-full h-36 border-t border-black/10 px-3 py-2.5 flex flex-col justify-between">
      <header class="flex justify-between items-center">
        <h2>
          Total: 
        </h2>
        <span class="text-lg font-semibold">
          $421.59
        </span>
      </header>

      <button class="w-full rounded-full px-1.5 py-3 bg-emerald-500 text-white text-center cursor-pointer hover:bg-emerald-600 active:bg-emerald-500 shadow hover:shadow-lg transition-all">Buy(2)</button>
    </footer>
  </aside>
</nav>

<script>
  const sanitazeNumber = (element, minOrder, maxOrder) => {
    element.value = element.value.replace(/[^0-9]/g, '');
    if(element.value != ''){
      let val = parseInt(element.value);
      if(val < minOrder) element.value = minOrder;
      if(val > maxOrder) element.value = maxOrder;
    }else{
      element.value = 1;
    }

    return element.value;
  }
</script>
