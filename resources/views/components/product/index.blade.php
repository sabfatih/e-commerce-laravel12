<x-app-layout>
  <main class="lg:container lg:mx-auto lg:flex lg:gap-x-8 lg:justify-center relative">
    <aside
      id="filter-sidebar"
      class="absolute -translate-x-full lg:translate-x-0 bg-gray-100 left-0 lg:static w-48 lg:w-64 -my-4 lg:mt-8 pt-2.5 shadow-lg lg:rounded-md transition-all duration-[400ms] h-fit">
      <h2 class="text-xl font-semibold px-3 mb-2 flex justify-between items-center">
        <span>Filter</span>
        <button onclick="closeFilterSidebar()" class="cursor-pointer lg:hidden">
          <i class="fas fa-xmark text-2xl"></i>
        </button>
      </h2>
      <div class="divide-y divide-black/10">
        <section x-data="{open: true}">
          <div x-on:click="open = !open" class="flex justify-between items-center bg-gray-200/50 px-3 py-1 cursor-pointer">
            <span class="font-semibold">Store Types</span>
            <i x-cloak :class="open ? '-rotate-180' : ''" class="fas fa-chevron-down text-gray-600 transition-all"></i>
          </div>

          <div
            x-show="open"
            x-collapse
            x-transition:enter="duration-400"
            x-transition:leave="duration-400"
            class="w-full origin-top">
            <div class="flex flex-col text-sm gap-y-2 pl-4 pr-3 py-3">
              <label class="flex gap-x-1 grow cursor-pointer">
                <div class="size-6 aspect-square rounded-md border-2 border-primary-500 overflow-hidden my-auto">
                  <input type="checkbox" id="official-store" name="official-store" class="hidden peer">
                  <div class="size-full bg-primary-500 rounded-sm hidden peer-checked:flex">
                    <i class="fas fa-check text-white m-auto"></i>
                  </div>
                </div>
                <span class="my-auto text-gray-600 whitespace-nowrap">Official Store</span>
              </label>
              <label class="flex gap-x-1 grow cursor-pointer">
                <div class="size-6 aspect-square rounded-md border-2 border-primary-500 overflow-hidden my-auto">
                  <input type="checkbox" id="power-merchant-pro" name="power-merchant-pro" class="hidden peer">
                  <div class="size-full bg-primary-500 rounded-sm hidden peer-checked:flex">
                    <i class="fas fa-check text-white m-auto"></i>
                  </div>
                </div>
                <span class="my-auto text-gray-600 whitespace-nowrap">Power Merchant Pro</span>
              </label>
              <label class="flex gap-x-1 grow cursor-pointer">
                <div class="size-6 aspect-square rounded-md border-2 border-primary-500 overflow-hidden my-auto">
                  <input type="checkbox" id="power-merchant" name="power-merchant" class="hidden peer">
                  <div class="size-full bg-primary-500 rounded-sm hidden peer-checked:flex">
                    <i class="fas fa-check text-white m-auto"></i>
                  </div>
                </div>
                <span class="my-auto text-gray-600 whitespace-nowrap">Power Merchant</span>
              </label>
            </div>
          </div>
        </section>

        <section x-data="{open: true}">
          <div x-on:click="open = !open" class="flex justify-between items-center bg-gray-200/50 px-3 py-1 cursor-pointer">
            <span class="font-semibold">Categories</span>
            <i x-cloak :class="open ? '-rotate-180' : ''" class="fas fa-chevron-down text-gray-600 transition-all"></i>
          </div>

          <div
            x-show="open"
            x-collapse
            x-transition:enter="duration-400"
            x-transition:leave="duration-400"
            class="w-full origin-top">
            <div class="flex flex-col text-sm gap-y-2 pl-4 pr-3 py-3">
              @foreach ($randomCategories as $randomCategory)
              <label class="flex gap-x-1 grow cursor-pointer">
                <div class="size-6 aspect-square rounded-md border-2 border-primary-500 overflow-hidden my-auto">
                  <input type="checkbox" id="{{ $randomCategory->slug }}" name="{{ $randomCategory->slug }}" class="hidden peer">
                  <div class="size-full bg-primary-500 rounded-sm hidden peer-checked:flex">
                    <i class="fas fa-check text-white m-auto"></i>
                  </div>
                </div>
                <span class="my-auto text-gray-600 whitespace-nowrap">{{ $randomCategory->name }}</span>
              </label>
              @endforeach
              <span class="font-[500] text-primary-500 cursor-pointer tracking-wide w-fit">See more</span>
            </div>
          </div>
        </section>

        <section x-data="{open: true}">
          <div x-on:click="open = !open" class="flex justify-between items-center bg-gray-200/50 px-3 py-1 cursor-pointer">
            <span class="font-semibold">Prices</span>
            <i x-cloak :class="open ? '-rotate-180' : ''" class="fas fa-chevron-down text-gray-600 transition-all"></i>
          </div>

          <div
            x-show="open"
            x-collapse
            x-transition:enter="duration-400"
            x-transition:leave="duration-400"
            class="w-full origin-top">
            <div class="flex flex-col text-sm gap-y-2 pl-4 pr-3 py-3">
              <label class="w-full flex rounded-md border border-black/0 focus-within:border-primary-500 transition-all">
                <div class="w-16 bg-gray-300 flex rounded-l-md">
                  <i class="fas fa-dollar-sign m-auto text-gray-600"></i>
                </div>
                <input onblur="minPriceCheck(event.target)" oninput="sanitazeNumber(event.target)" type="text" name="minPrice" id="minPrice" class=" w-full h-full border-0 rounded-r-md focus:ring-0" placeholder="Min. Price" autocomplete="off">
              </label>

              <label class="w-full flex rounded-md border border-black/0 focus-within:border-primary-500 transition-all">
                <div class="w-16 bg-gray-300 flex rounded-l-md">
                  <i class="fas fa-dollar-sign m-auto text-gray-600"></i>
                </div>
                <input onblur="maxPriceCheck(event.target)" oninput="sanitazeNumber(event.target)" type="text" name="maxPrice" id="maxPrice" class=" w-full h-full border-0 rounded-r-md focus:ring-0" placeholder="Max. Price" autocomplete="off">
              </label>
            </div>
          </div>
        </section>

        <section x-data="{open: true}">
          <div x-on:click="open = !open" class="flex justify-between items-center bg-gray-200/50 px-3 py-1 cursor-pointer">
            <span class="font-semibold">Locations</span>
            <i x-cloak :class="open ? '-rotate-180' : ''" class="fas fa-chevron-down text-gray-600 transition-all"></i>
          </div>

          <div
            x-show="open"
            x-collapse
            x-transition:enter="duration-400"
            x-transition:leave="duration-400"
            class="w-full origin-top">
            <div class="flex flex-col text-sm gap-y-2 pl-4 pr-3 py-3">
              @foreach (range(1, 5) as $i)
              <label class="flex gap-x-1 grow cursor-pointer">
                <div class="size-6 aspect-square rounded-md border-2 border-primary-500 overflow-hidden my-auto">
                  <input type="checkbox" id="yogyakarta" name="yogyakarta" class="hidden peer">
                  <div class="size-full bg-primary-500 rounded-sm hidden peer-checked:flex">
                    <i class="fas fa-check text-white m-auto"></i>
                  </div>
                </div>
                <span class="my-auto text-gray-600 whitespace-nowrap">Yogyakarta</span>
              </label>
              @endforeach
              <span class="font-[500] text-primary-500 cursor-pointer tracking-wide w-fit">See more</span>
            </div>
          </div>
        </section>

        <section x-data="{open: true}">
          <div x-on:click="open = !open" class="flex justify-between items-center bg-gray-200/50 px-3 py-1 cursor-pointer">
            <span class="font-semibold">Ratings</span>
            <i x-cloak :class="open ? '-rotate-180' : ''" class="fas fa-chevron-down text-gray-600 transition-all"></i>
          </div>

          <div
            x-show="open"
            x-collapse
            x-transition:enter="duration-400"
            x-transition:leave="duration-400"
            class="w-full origin-top">
            <div class="flex flex-col text-sm gap-y-2 pl-4 pr-3 py-3">
              @foreach (range(1, 5) as $i)
              <label class="flex gap-x-1 grow cursor-pointer">
                <div class="size-6 aspect-square rounded-md border-2 border-primary-500 overflow-hidden my-auto">
                  <input type="checkbox" id="{{ $i }}" name="{{ $i }}" class="hidden peer">
                  <div class="size-full bg-primary-500 rounded-sm hidden peer-checked:flex">
                    <i class="fas fa-check text-white m-auto"></i>
                  </div>
                </div>
                <span class="my-auto text-gray-600 whitespace-nowrap">
                  <i class="fas fa-star text-yellow-400"></i>
                  {{ $i }}
                </span>
              </label>
              @endforeach
            </div>
          </div>
        </section>

        <section x-data="{open: true}">
          <div x-on:click="open = !open" class="flex justify-between items-center bg-gray-200/50 px-3 py-1 cursor-pointer">
            <span class="font-semibold">Last Added</span>
            <i x-cloak :class="open ? '-rotate-180' : ''" class="fas fa-chevron-down text-gray-600 transition-all"></i>
          </div>

          <div
            x-show="open"
            x-collapse
            x-transition:enter="duration-400"
            x-transition:leave="duration-400"
            class="w-full origin-top">
            <div class="flex flex-col text-sm gap-y-3 pl-4 pr-3 py-4">

              <label class="w-full flex px-5 py-2 text-gray-400 border-2 rounded-md border-black/20 cursor-pointer has-checked:text-primary-500 has-checked:border-primary-500 transition-all">
                <input onchange="lastAddedHandler(event.target)" type="checkbox" id="last7days" name="lastAddedDays" value="7" class="hidden">
                <span class="m-auto font-[500]">7 Days</span>
              </label>
              
              <label class="w-full flex px-5 py-2 text-gray-400 border-2 rounded-md border-black/20 cursor-pointer has-checked:text-primary-500 has-checked:border-primary-500 transition-all">
                <input onchange="lastAddedHandler(event.target)" type="checkbox" id="last14days" name="lastAddedDays" value="14" class="hidden">
                <span class="m-auto font-[500]">14 Days</span>
              </label>

              <label class="w-full flex px-5 py-2 text-gray-400 border-2 rounded-md border-black/20 cursor-pointer has-checked:text-primary-500 has-checked:border-primary-500 transition-all">
                <input onchange="lastAddedHandler(event.target)" type="checkbox" id="last30days" name="lastAddedDays" value="30" class="hidden">
                <span class="m-auto font-[500]">1 Month</span>
              </label>

              <label class="w-full flex px-5 py-2 text-gray-400 border-2 rounded-md border-black/20 cursor-pointer has-checked:text-primary-500 has-checked:border-primary-500 transition-all">
                <input onchange="lastAddedHandler(event.target)" type="checkbox" id="last100days" name="lastAddedDays" value="100" class="hidden">
                <span class="m-auto font-[500]">3 Months</span>
              </label>
            </div>
          </div>
        </section>

  
        
      </div>
    </aside>

    <div class="mx-auto max-w-lg sm:max-w-2xl md:max-w-4xl lg:max-w-6xl xl:max-w-7xl xl:mx-0">
      <button onclick="toggleFilterSidebar()" class="lg:hidden m-4 flex justify-center items-center px-4 py-2 rounded-lg ring-1 ring-black/20 focus:ring-2 focus:ring-primary-500 transition-all cursor-pointer shadow hover:shadow-md">
        <span class="font-semibold">Filter</span>
        <i class="fas fa-filter ml-2"></i>
      </button>
    </div>

    
    <div class="px-4 pb-8 lg:pt-8 grid justify-items-center grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 gap-x-4 gap-y-6 sm:gap-6 mx-auto max-w-lg sm:max-w-2xl md:max-w-4xl lg:max-w-6xl xl:max-w-7xl xl:mx-0">

      @foreach ($products as $product)

        <a href="{{ route('product.show', $product->id) }}" class="w-full min-w-28 lg:max-w-48 rounded-md shadow bg-white hover:shadow-md transition-all cursor-pointer">
          <img src="{{ asset('storage').'/product-thumbs/'.$productImages[$product->id] }}" alt="{{ $product->name }}" loading="lazy" class="aspect-square rounded-t-md object-cover border-b border-b-black/10">
          <div class="px-3 py-2 space-y-0.5">
            <h3 class="sm:text-lg">{{ Str::limit($product->name, 10) }}</h3>
            <h3 class="sm:text-lg font-semibold">${{ $product->price }}</h3>
            <span class="text-xs sm:text-sm italic text-primary-400 block font-[550]">Free delivery</span>
            <span class="text-sm sm:text-base text-gray-600 block whitespace-nowrap">
              <span>
                <i class="fas fa-star text-yellow-400"></i>
                5.0
              </span>
              &bull;
              <span>1k+ sold</span>
            </span>
            <span class="block text-sm sm:text-base text-gray-500 font-[350]">
              <img src="{{ asset('/storage/testing/power-merchant-pro.png') }}" alt="Power Merchant Pro Icon" class="size-4 inline">
              <span>
                Flavouro
              </span>
            </span>
          </div>
        </a>
      @endforeach
    </div>
  </main>

  @push('scripts-body')
    <script>
      const sanitazeNumber = (eTarget) => {
        eTarget.value = +eTarget.value.replace(/[^0-9]/g, '');
        if(eTarget.value <= 0){
          eTarget.value = '';
        }

        let numberLength = eTarget.value.length;
        let logicArray = [];
        while(numberLength >= 4){
          let initialString = '.'+eTarget.value.slice(numberLength - 3, numberLength);
          logicArray.unshift(initialString);
          numberLength -= 3;
        }
        
        if(eTarget.value.length >= 4){
          eTarget.value = eTarget.value.slice(0, numberLength) + logicArray.join('');  
        }
      }

      const minPriceInput = document.querySelector('#minPrice');
      const maxPriceInput = document.querySelector('#maxPrice');

      const minPriceCheck = (eTarget) => {
        const minPriceValue = +eTarget.value.replace(/\./g, '');
        const maxPriceInputValue = +maxPriceInput.value.replace(/\./g, '');
        if(maxPriceInput.value && minPriceValue >= maxPriceInputValue){
          eTarget.value = '';
        }
      }

      const maxPriceCheck = (eTarget) => {
        const maxPriceValue = +eTarget.value.replace(/\./g, '');
        const minPriceInputValue = +minPriceInput.value.replace(/\./g, '');
        if(minPriceInput.value && maxPriceValue <= minPriceInputValue){
          eTarget.value = '';
        }
      }


      const last7days = document.querySelector('#last7days');
      const last14days = document.querySelector('#last14days');
      const last30days = document.querySelector('#last30days');
      const last100days = document.querySelector('#last100days');

      const lastAddedHandler = (eTarget) => {
        const userChecked = eTarget.checked;
        
        [last7days, last14days, last30days, last100days].forEach(checkbox => {
          checkbox.checked = eTarget.id == checkbox.id;
        });

        if(!userChecked){
          eTarget.checked = false;
        }
      }

      const filterSidebar = document.querySelector('#filter-sidebar');
      const toggleFilterSidebar = () => {
        filterSidebar.classList.toggle('-translate-x-full');
      }
      const closeFilterSidebar = () => {
        filterSidebar.classList.add('-translate-x-full');
      }

    </script>
  @endpush
</x-app-layout>