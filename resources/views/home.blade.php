<x-guest-layout>
  <main class="container min-h-dvh mx-auto md:px-8 font-dm text-gray-800">
    {{-- carousel --}}
    <section 
      x-data="{
        accorPercent: 0,
        accorImages: ['1-accor.jpg', '2-accor.jpg', '3-accor.jpg', '4-accor.jpg'], 
        baseImageURL: '{{ asset('storage/testing') }}/',
        timeout: null,
        stopTransition: true,
        interval:null,
        start(){
          requestAnimationFrame(() => stopTransition = false);
          this.interval = setInterval(() => {
            this.nextImage(true);
          }, 5000);
        },
        disableButton: false,
        prevImage(){
          clearInterval(this.interval);
          this.disableButton = true;
          this.accorPercent = this.accorPercent - 100;
          clearTimeout(this.timeout);
          this.timeout = setTimeout(() => {
            this.stopTransition = true;
            this.accorImages.unshift(this.accorImages.pop());
            this.accorPercent = this.accorPercent + 100;
            this.disableButton = false;
          }, 1000)
          this.stopTransition = false;
          this.interval = setInterval(() => {
            this.nextImage(true);
          }, 5000);
        },
        nextImage(isAuto = false){
          if(!isAuto){
            clearInterval(this.interval);
          }
          this.disableButton = true;
          this.accorPercent = this.accorPercent + 100;
          clearTimeout(this.timeout);
          this.timeout = setTimeout(() => {
            this.stopTransition = true;
            this.accorImages.push(this.accorImages.shift());
            this.accorPercent = this.accorPercent - 100;
            this.disableButton = false;
          }, 1000);
          this.stopTransition = false;
          if(!isAuto){
            this.interval = setInterval(() => {
              this.nextImage(true);
            }, 5000);
          };
        },
      }"
      x-init="start()"
      class="md:mt-8 w-full mx-auto md:rounded-md h-fit relative group">
    
      <div class="w-full md:rounded-md overflow-hidden relative">
        <div 
        :style="`transform: translateX(-${100+accorPercent}%)`"
        :class="!stopTransition ? 'transition-transform duration-1000' : ''" 
        class="flex w-full"
        >
          <template x-for="(image, i) in accorImages">
            <img 
            :src="baseImageURL + image" alt="image" class="min-w-full h-full cursor-pointer">
          </template>
        </div>
      </div>
    
      <button x-on:click="prevImage()" :disabled="disableButton" class="hidden md:flex rounded-full size-12 p-2 absolute -left-6 top-1/2 -translate-y-1/2 bg-white cursor-pointer shadow-md active:scale-100 translate-x-12 scale-80 opacity-0 group-hover:translate-x-0 group-hover:scale-100 group-hover:opacity-100 hover:scale-105 transition-all duration-300 z-10">
        <i class="fas fa-chevron-left text-xl m-auto"></i>
      </button>
      <button x-on:click="nextImage()" :disabled="disableButton" class="hidden md:flex rounded-full size-12 p-2 absolute -right-6 top-1/2 -translate-y-1/2 bg-white cursor-pointer shadow-md active:scale-100 -translate-x-12 scale-80 opacity-0 group-hover:translate-x-0 group-hover:scale-100 group-hover:opacity-100 hover:scale-105 transition-all duration-300 z-10">
        <i class="fas fa-chevron-right text-xl m-auto"></i>
      </button>
    </section>

    {{-- products --}}
    <section class="px-2.5">
      <header class="flex justify-between gap-x-6 my-6">
        <h2 class="text-xl md:text-2xl lg:text-3xl font-[500] my-auto">Products</h2>
        <a href="{{ route('product.index') }}" class="flex justify-center items-center px-3 py-2 rounded-lg ring-1 ring-black/20 focus:ring-2 focus:ring-primary-500 transition-all cursor-pointer shadow hover:shadow-md">
          <span class="font-semibold">Filter</span>
          <i class="fas fa-filter ml-2"></i>
        </a>
      </header>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-x-3 sm:gap-x-4 md:gap-x-6 gap-y-4 md:gap-y-6">
        <template x-data="{i: 10}" x-for="items in i">
          <a href="{{ route('product.show', 1) }}" class="w-full aspect-[3/4] md:aspect-[3/5] rounded-md shadow bg-white hover:shadow-md transition-all cursor-pointer">
            <img src="https://images.unsplash.com/photo-1496116218417-1a781b1c416c?q=80&w=1598&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" :alt="'Product-'+items" class="aspect-square rounded-t-md object-cover border-b border-b-black/10">
            <div class="px-3 py-2 space-y-0.5">
              <h3>Tasty Sybau</h3>
              <h3 class="font-semibold">$8.99</h3>
              <span class="text-xs italic text-primary-400 block font-[550]">Free delivery</span>
              <span class="text-sm text-gray-600 block">
                <span>
                  <i class="fas fa-star text-yellow-400"></i>
                  5.0
                </span>
                &bull;
                <span>1k+ sold</span>
              </span>
              <span class="block text-sm text-gray-500 font-[350]">
                {{-- <i class="fa fa-shop text-xs"></i> --}}
                <img src="{{ asset('/storage/testing/power-merchant-pro.png') }}" alt="Power Merchant Pro Icon" class="size-4 inline">
                <span>
                  Flavouro
                </span>
              </span>
            </div>
          </a>
        </template>
      </div>
      <div class="flex justify-center items-center">
        <button class="px-8 py-2.5 rounded-sm ring-1 ring-primary-400 text-primary-400 my-8 font-[550] text-lg cursor-pointer tracking-wide shadow hover:shadow-md transition-all">Load more</button>
      </div>
    </section>
  </main>
</x-guest-layout>

{{-- accorPercent = (i - 1) * 100 --}}

{{-- [
  0 => 'saya',
    1 => 'kursi',
  2 => 'pensil',
  3 => 'tembok',
]
  
ambil elemen ke ((target-1 + this.accorPercent.length) % this.accorPercent.length)
ambil elemen ke (target % this.accorPercent.length)
ambil elemen ke ((target+1) % this.accorPercent.length)
ambil elemen ke ((target+2) % this.accorPercent.length)

2
1 2 3 0
--}}