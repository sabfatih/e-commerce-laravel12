<x-guest-layout>
  <main class="container bg-amber-50 h-dvh mx-auto">
    <section 
    x-data="{
      accorPercent: 0,
      accorImages: ['1-accor.jpg', '2-accor.jpg', '3-accor.jpg', '4-accor.jpg'], 
      currentImageIndex: 0,
      baseImageURL: '{{ asset('storage/testing') }}/',
      timeout: null,
      stopTransition: false,
      interval:null,
      makeInterval(){
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
        this.currentImageIndex = (this.currentImageIndex - 1 + this.accorImages.length) % this.accorImages.length;
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
        }, 1000)
        this.stopTransition = false;
        if(!isAuto){
          this.interval = setInterval(() => {
            this.nextImage();
          }, 5000);
        };
        this.currentImageIndex = (this.currentImageIndex + 1) % this.accorImages.length;
      },
      moveToImage(i){
        clearInterval(this.interval);
        this.disableButton = true;
        this.accorImages = [
          this.accorImages[(i-1+this.accorImages.length) % this.accorImages.length], 
          this.accorImages[i % this.accorImages.length], 
          this.accorImages[i+1 % this.accorImages.length], 
          this.accorImages[i+2 % this.accorImages.length]
        ];
        console.log(` moveToImage ~ this.accorImages:`, this.accorImages);

        

        this.disableButton = false;
        this.interval = setInterval(() => {
          this.nextImage();
        }, 5000);
        this.currentImageIndex = (this.currentImageIndex + 1) % this.accorImages.length;
      }
    }"
    interval:null,
    x-init="makeInterval()"

    class="mt-8 w-full rounded-md h-fit bg-sky-200 relative group">
      <button x-on:click="prevImage()" :disabled="disableButton" class="rounded-full size-12 p-2 flex absolute -left-6 top-1/2 -translate-y-1/2 bg-white cursor-pointer shadow-md active:scale-100 translate-x-12 scale-80 opacity-0 group-hover:translate-x-0 group-hover:scale-100 group-hover:opacity-100 hover:scale-105 transition-all duration-300 z-10">
        <i class="fas fa-chevron-left text-xl m-auto"></i>
      </button>
      <div
      class="flex w-full rounded-md overflow-hidden relative">
        <img src="{{ asset('storage/testing/1-accor.jpg') }}" alt="filler" class="w-full opacity-0">
        <template x-for="(image, i) in accorImages">
          <img 
          :style="`transform: translateX(${(i-1)*100 - accorPercent}%)`"
          :class="!stopTransition ? 'transition-all duration-1000' : ''" 
          :src="baseImageURL + image" alt="image" class="min-w-full cursor-pointer absolute inset-0">
        </template>
      </div>
      <button x-on:click="nextImage()" :disabled="disableButton" class="rounded-full size-12 p-2 flex absolute -right-6 top-1/2 -translate-y-1/2 bg-white cursor-pointer shadow-md active:scale-100 -translate-x-12 scale-80 opacity-0 group-hover:translate-x-0 group-hover:scale-100 group-hover:opacity-100 hover:scale-105 transition-all duration-300 z-10">
        <i class="fas fa-chevron-right text-xl m-auto"></i>
      </button>

      <div class="absolute -translate-x-1/2 left-1/2 bottom-1.5 flex gap-x-1">
        <template x-for="(image, i) in accorImages">
          <div>
            <input x-on:change="moveToImage(event.target.value)" type="radio" name="image" :id="i" class="hidden peer" :value="i" :checked="i == currentImageIndex">
            <label :for="i" class="size-1.5 block bg-white/30 peer-checked:bg-white cursor-pointer shadow rounded-full transition-all"></label>
          </div>
        </template>
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