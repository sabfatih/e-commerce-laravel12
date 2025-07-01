<x-app-layout>

  @push('styles')
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #fafafa;
        }
        
        .product-image {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .product-image:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .thumbnail {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        
        .thumbnail:hover, .thumbnail.active {
            border-color: #3b82f6;
            transform: scale(1.05);
        }
        
        .add-to-cart {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .add-to-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);
        }
        
        .add-to-cart:active {
            transform: translateY(1px);
        }
        
        .add-to-cart::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: scale(0);
            transition: transform 0.5s ease;
            border-radius: 50%;
        }
        
        .add-to-cart:active::after {
            transform: scale(1);
        }
        
        .in-stock {
            background-color: #10b981;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 1);
            animation: pulse-slow 2s infinite;
        }
        
        .detail-card {
            transition: all 0.3s ease;
        }
        
        .detail-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }
        
        .tab-button {
            transition: all 0.2s ease;
        }
        
        .tab-button.active {
            border-bottom: 2px solid #3b82f6;
            color: #3b82f6;
        }
        
        .tab-content {
            animation: fade-in 0.4s ease-out;
        }
        
        .quantity-btn {
            transition: all 0.2s ease;
        }
        
        .quantity-btn:hover {
            background-color: #e5e7eb;
        }
    </style>
  @endpush

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
          <div class="lg:w-1/2">
                {{-- Showed product image --}}
                <div class="bg-white rounded-xl shadow-sm overflow-x-hidden overflow-y-auto max-h-[32rem] mb-4 product-image">
                    <img id="mainImage" src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" 
                          alt="Minimalist Wireless Headphones" 
                          class="w-full h-auto object-cover rounded-xl">
                </div>
                
                {{-- Product images --}}
                <div class="grid grid-cols-4 gap-3">
                    <div class="thumbnail rounded-lg border-2 border-gray-200 p-1 cursor-pointer active" 
                        onclick="changeImage('https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80')">
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80" 
                            alt="Thumbnail 1" 
                            class="w-full h-32 object-cover rounded-md">
                    </div>
                    <div class="thumbnail rounded-lg border-2 border-gray-200 p-1 cursor-pointer" 
                        onclick="changeImage('https://images.unsplash.com/photo-1572536147248-ac59a8abfa4b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80')">
                        <img src="https://images.unsplash.com/photo-1572536147248-ac59a8abfa4b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80" 
                              alt="Thumbnail 3" 
                              class="w-full h-32 object-cover rounded-md">
                    </div>
                    <div class="thumbnail rounded-lg border-2 border-gray-200 p-1 cursor-pointer" 
                        onclick="changeImage('https://images.unsplash.com/photo-1583394838336-acd977736f90?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80')">
                        <img src="https://images.unsplash.com/photo-1583394838336-acd977736f90?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80" 
                              alt="Thumbnail 4" 
                              class="w-full h-32 object-cover rounded-md">
                    </div>
                </div>
            </div>
            
            <!-- Product Details -->
            <div class="lg:w-1/2">
                <div class="bg-white rounded-xl shadow-sm p-6 detail-card">
                    <div class="mb-2">
                        <span class="text-sm font-medium text-blue-600 bg-blue-50 px-2 py-1 rounded">{{ $product->categories->pluck('name')->implode(', ') }}</span>
                    </div>
                    
                    <h1 class="text-3xl font-bold text-gray-800 mb-3">{{ $product->name }}</h1>
                    
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-gray-500 ml-2">(142 reviews)</span>
                    </div>
                    
                    <p class="text-gray-600 mb-6">
                        {{ $product->description }}
                    </p>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-gray-500 text-sm mb-1">Price</div>
                            <div class="text-2xl font-bold text-gray-800">${{ $product->price }}</div>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-gray-500 text-sm mb-1">Weight</div>
                            <div class="text-xl font-semibold text-gray-800">{{ $product->weight }} kg</div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center mb-2">
                            <span class="size-2.5 rounded-full mr-2 inline-block in-stock"></span>
                            <span class="text-gray-700 font-medium">In Stock</span>
                        </div>
                        <div class="text-sm text-gray-500">Only {{ $product->stock }} items left</div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <form action="{{ route('cartItem.store') }}" method="POST">
                          @csrf
                          <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                          <button class="add-to-cart cursor-pointer flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-all duration-300">
                              <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                          </button>
                        </form>

                        @if (in_array($product->id, $wishlistedProductIdByCurrentUser))
                          <form action="{{ route('wishlist.itemDestroy', array_keys($wishlistedProductIdByCurrentUser, $product->id)) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button class="flex-1 cursor-pointer border border-gray-300 text-gray-700 font-medium py-3 px-6 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fas fa-heart mr-2"></i> Wishlist
                            </button>
                          </form>
                        @else
                          <form action="{{ route('wishlist.itemStore', $product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="product-id" id="product-id" value="">
                            <button class="flex-1 cursor-pointer border border-gray-300 text-gray-700 font-medium py-3 px-6 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="far fa-heart mr-2"></i> Wishlist
                            </button>
                          </form>
                        @endif
                      
                        
                    </div>
                </div>
                
                <!-- Product Tabs -->
                <div class="mt-6 bg-white rounded-xl shadow-sm">
                    <div class="border-b border-gray-200">
                        <div class="flex">
                            <button class="tab-button py-4 px-6 font-medium text-gray-600 hover:text-gray-900 active" onclick="changeTab(0)">Description</button>
                            <button class="tab-button py-4 px-6 font-medium text-gray-600 hover:text-gray-900" onclick="changeTab(1)">Specifications</button>
                            <button class="tab-button py-4 px-6 font-medium text-gray-600 hover:text-gray-900" onclick="changeTab(2)">Reviews</button>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="tab-content">
                            <div id="tab0">
                                <h3 class="text-lg font-semibold mb-3">Product Description</h3>
                                <p class="text-gray-600 mb-4">
                                    Our Minimalist Wireless Headphones combine premium sound quality with elegant design. 
                                    Featuring noise cancellation technology, these headphones provide an immersive audio 
                                    experience whether you're listening to music, podcasts, or taking calls.
                                </p>
                                <p class="text-gray-600 mb-4">
                                    With a battery life of up to 30 hours, you can enjoy uninterrupted listening throughout 
                                    your day. The ergonomic design ensures comfort during extended wear, and the foldable 
                                    construction makes them perfect for travel.
                                </p>
                                <ul class="list-disc pl-5 text-gray-600 space-y-1">
                                    <li>Active Noise Cancellation</li>
                                    <li>30-hour battery life</li>
                                    <li>Bluetooth 5.2 connectivity</li>
                                    <li>Voice assistant support</li>
                                    <li>Foldable design</li>
                                </ul>
                            </div>
                            
                            <div id="tab1" class="hidden">
                                <h3 class="text-lg font-semibold mb-3">Technical Specifications</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <h4 class="font-medium text-gray-700 mb-2">General</h4>
                                        <ul class="space-y-2">
                                            <li class="flex justify-between">
                                                <span class="text-gray-600">Model</span>
                                                <span class="text-gray-800">MH-2023</span>
                                            </li>
                                            <li class="flex justify-between">
                                                <span class="text-gray-600">Color</span>
                                                <span class="text-gray-800">Matte Black</span>
                                            </li>
                                            <li class="flex justify-between">
                                                <span class="text-gray-600">Weight</span>
                                                <span class="text-gray-800">0.5 kg</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-700 mb-2">Audio</h4>
                                        <ul class="space-y-2">
                                            <li class="flex justify-between">
                                                <span class="text-gray-600">Driver Size</span>
                                                <span class="text-gray-800">40mm</span>
                                            </li>
                                            <li class="flex justify-between">
                                                <span class="text-gray-600">Frequency Response</span>
                                                <span class="text-gray-800">20Hz - 20kHz</span>
                                            </li>
                                            <li class="flex justify-between">
                                                <span class="text-gray-600">Impedance</span>
                                                <span class="text-gray-800">32Ω</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="tab2" class="hidden">
                                <h3 class="text-lg font-semibold mb-3">Customer Reviews</h3>
                                <div class="flex items-center mb-4">
                                    <div class="text-3xl font-bold text-gray-800 mr-4">4.7</div>
                                    <div>
                                        <div class="flex text-yellow-400 mb-1">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <div class="text-gray-500 text-sm">Based on 142 reviews</div>
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <div class="border-b border-gray-100 pb-4">
                                        <div class="flex justify-between mb-2">
                                            <h4 class="font-medium">Alex Johnson</h4>
                                            <div class="text-yellow-400">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="text-gray-600 text-sm">
                                            These headphones exceeded my expectations! The sound quality is incredible and 
                                            the noise cancellation works perfectly. Highly recommend!
                                        </p>
                                    </div>
                                    
                                    <div class="border-b border-gray-100 pb-4">
                                        <div class="flex justify-between mb-2">
                                            <h4 class="font-medium">Sarah Williams</h4>
                                            <div class="text-yellow-400">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="text-gray-600 text-sm">
                                            Great headphones overall. Comfortable for long periods and the battery lasts forever. 
                                            The only downside is they're a bit heavy.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Related Products -->
    <section class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">You May Also Like</h2>
        <div
        x-data="lazyLoader('{{ $product->id }}', {{ $product->categories->pluck('id') }})"
        x-intersect.once="load()"
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Product 1 -->
            <template x-for="item in items">
              <a :href="`{{ route('product.show', ':id') }}`.replace(':id', item.id)" class="bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
                  <div class="p-4">
                      <img src="https://images.unsplash.com/photo-1545127398-14699f92334b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=735&q=80" 
                            alt="Wireless Earbuds" 
                            class="w-full h-48 object-cover mb-4">
                      <h3 x-text="item.name" class="font-medium text-gray-800 mb-1"></h3>
                      <div class="text-blue-600 font-semibold">$<span x-text="item.price"></span></div>
                  </div>
              </a>
            </template>
        </div>
    </section>

    @push('scripts-body') 
      <script>
          // Change main product image
          function changeImage(src) {
              const mainImg = document.getElementById('mainImage');
              
              mainImg.src = src;
              
              // Update active thumbnail
              document.querySelectorAll('.thumbnail').forEach(thumb => {
                  thumb.classList.remove('active');
              });
              event.currentTarget.classList.add('active');
          }
          
          // Change tabs
          const changeTab = (index) => {
            document.querySelectorAll('.tab-button').forEach((button,i) => {
              if(i == index){
                button.classList.add('active');
              }else{
                button.classList.remove('active');
              }
            });

            document.querySelectorAll('.tab-content > div').forEach((div, i) => {
              if(i == index){
                div.classList.remove('hidden')
              }else{
                div.classList.add('hidden')
              }
            });
          }
          
          // Add to cart animation
          document.querySelector('.add-to-cart').addEventListener('click', function() {
              this.innerHTML = '<i class="fas fa-check mr-2"></i> Added to Cart';
              this.classList.remove('bg-blue-600', 'hover:bg-blue-700', 'cursor-pointer');
              this.classList.add('bg-green-500');
              this.disabled = true;
          });

          // "You may also like" feature with lazy loading


          // query 'generator' that can handle array
          const toQueryString = (obj) => {
            const params = new URLSearchParams();
            
            for(const key in obj){
              const value = obj[key];
              
              if(Array.isArray(value)){
                value.forEach(v => {
                  params.append(`${key}[]`, v);
                });
              }else if(value !== undefined && value !== null){
                params.append(key, value);
              }
            }
            return params.toString();
          }

          const lazyLoader = (productId, categories) => {

            const params = toQueryString({productId, categories});

            return {
              loading: true,
              items: [],
              async load() {
                this.loading = true;
                const res = await fetch(`/api/product/related?${params}`);
                const data = await res.json();

                this.items = data;
                this.loading = false;
              }
            }
          }

          
      </script>
    @endpush

</x-app-layout>