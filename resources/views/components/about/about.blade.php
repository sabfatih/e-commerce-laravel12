<x-layouts.about>
  <main class="text-black font-inter">
    <section class="container mx-auto">
      <header class="min-h-dvh w-full px-8 md:px-0 md:w-1/2 pt-40">
        <h1 class="text-5xl md:text-6xl font-bold mb-6">Our Story at <span class="text-primary-600 block">FaStore</span></h1>
        <p class="text-gray-400 text-base md:text-lg">Founded in 2015, FaStore has grown from a small startup to a leading e-commerce platform, serving millions of customers worldwide with quality products and exceptional service.</p>
  
        <div class="flex flex-col sm:flex-row gap-4 mt-8">
          <a href="{{ route('product.index') }}" class="w-full sm:min-w-40 px-8 py-4 rounded-md bg-primary-600 shadow-md hover:-translate-y-[1px] hover:shadow-xl hover:bg-primary-700 active:bg-primary-600 transition-all text-lg whitespace-nowrap font-[500] text-gray-100 text-center cursor-pointer">
            Shop now
          </a>
          <button onclick="document.getElementById('mission').scrollIntoView({behavior: 'smooth'})" class="w-full sm:min-w-40 px-8 py-4 rounded-md bg-primary-100 shadow-md hover:-translate-y-[1px] hover:shadow-xl hover:bg-primary-200 active:bg-primary-100 transition-all text-lg whitespace-nowrap font-[500] text-primary-600 text-center cursor-pointer">
            Learn more
          </button>
        </div>
      </header>
    </section>

    <section id="mission" class="container mx-auto mb-16 h-fit">
      <header class="text-center px-8 md:px-0">
        <h4 class="uppercase text-center text-sm md:text-base text-primary-600 font-bold mb-2">Our Mission</h4>
        <h1 class="font-semibold text-3xl md:text-4xl mb-4">To make premium shopping accessible to everyone</h1>
        <p class="text-gray-400 text-base md:text-xl max-w-xl mx-auto">We believe in quality, affordability, and exceptional customer service as the foundation of our business.</p>
      </header>

      <div class="grid md:grid-cols-2 gap-x-6 gap-y-10 mt-12 px-12">
        <article class="rounded-lg px-6 pt-10 pb-4 border border-black/10 relative shadow hover:shadow-lg hover:-translate-y-1 transition-all">
          {{-- icon --}}
          <div class="size-12 bg-primary-500 rounded-md absolute -top-2/12 p-2 flex">
            <i class="m-auto fas fa-bolt text-xl text-white"></i>
          </div>

          <h3 class="text-lg font-semibold mb-2">Fast Delivery</h3>
          <p class="text-gray-400 text-sm md:text-base">We've optimized our logistics network to ensure your orders arrive in record time, with 95% of deliveries completed within 2 business days.</p>
        </article>

        <article class="rounded-lg px-6 pt-10 pb-4 border border-black/10 relative shadow hover:shadow-lg hover:-translate-y-1 transition-all">
          {{-- icon --}}
          <div class="size-12 bg-primary-500 rounded-md absolute -top-2/12 p-2 flex">
            <i class="m-auto fas fa-lock text-xl text-white"></i>
          </div>

          <h3 class="text-lg font-semibold mb-2">Secure Payment</h3>
          <p class="text-gray-400 text-sm md:text-base">Your security is our priority. All transactions are encrypted and processed through PCI-DSS compliant payment gateways.</p>
        </article>

        <article class="rounded-lg px-6 pt-10 pb-4 border border-black/10 relative shadow hover:shadow-lg hover:-translate-y-1 transition-all">
          {{-- icon --}}
          <div class="size-12 bg-primary-500 rounded-md absolute -top-2/12 p-2 flex">
            <i class="m-auto fas fa-cloud text-xl text-white"></i>
          </div>

          <h3 class="text-lg font-semibold mb-2">Quality Assurance</h3>
          <p class="text-gray-400 text-sm md:text-base">Every product undergoes rigorous quality checks before reaching you. Our 30-day return policy ensures your complete satisfaction.</p>
        </article>

        <article class="rounded-lg px-6 pt-10 pb-4 border border-black/10 relative shadow hover:shadow-lg hover:-translate-y-1 transition-all">
          {{-- icon --}}
          <div class="size-12 bg-primary-500 rounded-md absolute -top-2/12 p-2 flex">
            <i class="m-auto fas fa-gear text-xl text-white"></i>
          </div>

          <h3 class="text-lg font-semibold mb-2">24/7 Support</h3>
          <p class="text-gray-400 text-sm md:text-base">Our customer support team is available round the clock to assist you with any queries or concerns.</p>
        </article>
      </div>
    </section>

    <section class="w-full bg-primary-700 text-white mb-16 px-6 md:px-0 py-16 md:py-20 selection:bg-white selection:text-primary-700">
      <header class="text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Trusted by millions worldwide</h1>
        <h2 class="text-lg md:text-xl text-white/70">Our numbers speak for themselves. Here's what we've achieved so far.</h2>
      </header>

      <div class="flex flex-col md:flex-row mx-auto w-full max-w-2xl gap-x-4 gap-y-8 justify-between mt-12">
        <div class="text-center space-y-1">
          <span class="text-7xl md:text-5xl block font-semibold">10+</span>
          <span class="whitespace-nowrap text-lg md:text-base text-white/65">Happy Customers</span>
        </div>
        <div class="text-center space-y-1">
          <span class="text-7xl md:text-5xl block font-semibold">500+</span>
          <span class="whitespace-nowrap text-lg md:text-base text-white/65">Products Available</span>
        </div>
        <div class="text-center space-y-1">
          <span class="text-7xl md:text-5xl block font-semibold">150+</span>
          <span class="whitespace-nowrap text-lg md:text-base text-white/65">Country Served</span>
        </div>
      </div>
    </section>

    <section class="container mx-auto mb-16">
      <header class="mb-12 px-8 md:px-0">
        <h4 class="uppercase text-center text-sm md:text-base font-bold mb-2 text-primary-600">Our Team</h4>
        <h1 class="text-3xl md:text-4xl font-semibold text-center mb-4">The people behind FaStore</h1>
        <p class="max-w-lg text-base md:text-xl text-center text-gray-400 mx-auto">A diverse team of passionate professionals dedicated to revolutionizing e-commerce.</p>
      </header>

      <div class="px-2 grid grid-cols-2 sm:grid-cols-3 mx-auto justify-between gap-x-4 md:gap-x-10 gap-y-6 max-w-11/12">
        <div class="rounded-md w-full min-h-56 md:min-h-68 shadow hover:-translate-y-1 hover:shadow-md transition-all">
          <img src="#" alt="#" class="rounded-t-md w-full h-28 md:h-34 object-cover border-b border-black/10">

          <article class="px-3 md:px-4 py-2 md:py-2.5 space-y-1">
            <h3 class="text-primary-600 font-[500] text-xs md:text-base">CEO and Founder</h3>
            <h2 class="text-base md:text-xl font-semibold">Sabihisma Fatih</h2>
            <p class="text-xs md:text-base">Visionary leader with 15+ years in e-commerce and retail innovation.</p>
          </article>
        </div>

        <div class="rounded-md w-full min-h-56 md:min-h-68 shadow hover:-translate-y-1 hover:shadow-md transition-all">
          <img src="#" alt="#" class="rounded-t-md w-full h-28 md:h-34 object-cover border-b border-black/10">

          <article class="px-3 md:px-4 py-2 md:py-2.5 space-y-1">
            <h3 class="text-primary-600 font-[500] text-xs md:text-base">CTO</h3>
            <h2 class="text-base md:text-xl font-semibold">Sarah Johnson</h2>
            <p class="text-xs md:text-base">Technology innovator specializing in scalable e-commerce platforms.</p>
          </article>
        </div>

        <div class="rounded-md w-full min-h-56 md:min-h-68 shadow hover:-translate-y-1 hover:shadow-md transition-all">
          <img src="#" alt="#" class="rounded-t-md w-full h-28 md:h-34 object-cover border-b border-black/10">

          <article class="px-3 md:px-4 py-2 md:py-2.5 space-y-1">
            <h3 class="text-primary-600 font-[500] text-xs md:text-base">Head of Design</h3>
            <h2 class="text-base md:text-xl font-semibold">David Rodriguez</h2>
            <p class="text-xs md:text-base">UX/UI expert focused on creating seamless shopping experiences.</p>
          </article>
        </div>

      </div>
    </section>

    <section class="w-full bg-primary-100">
      <div class="container mx-auto flex flex-col md:flex-row gap-y-4 md:justify-between md:items-center px-8 md:px-0 py-16">
        <header>
          <h1 class="text-3xl md:text-4xl font-bold">Ready to experience FaStore? <span class="block text-primary-600">Start shopping today.</span></h1>
        </header>

          <a href="{{ route('product.index') }}" class="px-7 py-4 rounded-md w-fit bg-primary-600 text-white text-base md:text-lg font-semibold text-center shadow-md hover:bg-primary-700 hover:shadow-lg transition-all">
            Browse Products
          </a>
      </div>
    </section>
  </main>
</x-layouts.about>


