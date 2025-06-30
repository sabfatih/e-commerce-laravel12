<x-guest-layout>
  <main class="container bg-amber-50 min-h-dvh mx-auto px-8">
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
          this.disableButton = true;
        }
        this.accorPercent = this.accorPercent + 100;
        {{-- clearTimeout(this.timeout); --}}
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
    class="mt-8 w-full mx-auto rounded-md h-fit relative group">
    
      <div class="w-full rounded-md overflow-hidden relative">
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
    
      <button x-on:click="prevImage()" :disabled="disableButton" class="rounded-full size-12 p-2 flex absolute -left-6 top-1/2 -translate-y-1/2 bg-white cursor-pointer shadow-md active:scale-100 translate-x-12 scale-80 opacity-0 group-hover:translate-x-0 group-hover:scale-100 group-hover:opacity-100 hover:scale-105 transition-all duration-300 z-10">
        <i class="fas fa-chevron-left text-xl m-auto"></i>
      </button>
      <button x-on:click="nextImage()" :disabled="disableButton" class="rounded-full size-12 p-2 flex absolute -right-6 top-1/2 -translate-y-1/2 bg-white cursor-pointer shadow-md active:scale-100 -translate-x-12 scale-80 opacity-0 group-hover:translate-x-0 group-hover:scale-100 group-hover:opacity-100 hover:scale-105 transition-all duration-300 z-10">
        <i class="fas fa-chevron-right text-xl m-auto"></i>
      </button>
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