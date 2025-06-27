<footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <a href="{{ route('home') }}"><h3 class="text-xl font-bold mb-4">FaStore</h3></a>
                <p class="text-gray-400">
                    Explore the intersection of technology and style.
                </p>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Shop</h4>
                <ul class="space-y-2 text-gray-400">
                  @foreach ($footerCategories as $category)
                    <li><a href="{{ route('category.show', $category->id) }}" class="hover:text-white">{{ $category->name }}</a></li>
                  @endforeach
                </ul>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Support</h4>
                <ul class="space-y-2 text-gray-400">
                  <li><a href="{{ route('about') }}" class="hover:text-white">About</a></li>
                  <li><a href="{{ route('about', 'FAQs') }}" class="hover:text-white">FAQs</a></li>
                  <li><a href="{{ route('about', 'terms-condition') }}" class="hover:text-white">Terms & Condition</a></li>
                  <li><a href="{{ route('about', 'privacy') }}" class="hover:text-white">Privacy</a></li>
                  <li><a href="{{ route('about', 'contact-us') }}" class="hover:text-white">Contact Us</a></li>

                </ul>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Find us on social media</h4>
                <div class="flex w-full justify-start items-center gap-x-8">
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=fatihsabihisma2@gmail.com" class="hover:-translate-y-[1px] hover:text-primary-400 transition-all">
                      <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="" class="hover:-translate-y-[1px] hover:text-primary-400 transition-all">
                      <i class="fab fa-x-twitter text-2xl"></i>
                    </a>
                    <a href="" class="hover:-translate-y-[1px] hover:text-primary-400 transition-all">
                      <i class="fab fa-facebook text-2xl"></i>
                    </a>
                    <a href="" class="hover:-translate-y-[1px] hover:text-primary-400 transition-all">
                      <i class="fab fa-tiktok text-2xl"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
            <p>&copy; 2025 FaStore. All rights reserved.</p>
        </div>
    </div>
</footer>