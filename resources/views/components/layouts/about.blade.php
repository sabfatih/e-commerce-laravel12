<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="max-h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('styles')
        @stack('scripts-head')
    </head>
    <body class="font-sans antialiased">
        @php
          $content = request()->segment(2) ?? 'about';
          if(!in_array(strtolower($content), ['about', 'faqs', 'terms-condition', 'privacy', 'contact-us'])){
            $content = 'about';
          }
        @endphp

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav class="bg-white shadow-sm py-4 sticky top-0 w-full md:static z-10">
              <div class="container mx-auto px-4 flex justify-between items-center">
                  <a href="{{ route('home') }}" class="flex items-center">
                      <h1 class="text-xl md:text-2xl font-bold text-gray-800">FaStore</h1>
                  </a>
                  <nav class="hidden md:flex space-x-4">
                      <a href="{{ route('about') }}" class="px-2.5 py-1.5 text-gray-600 hover:text-gray-900 border-primary-500 {{ strtolower($content) == 'about' ? 'border-b-2' : '' }} transition-all">About</a>
                      <a href="{{ route('about', 'FAQs') }}" class="px-2.5 py-1.5 text-gray-600 hover:text-gray-900 border-primary-500 {{ strtolower($content) == 'faqs' ? 'border-b-2' : '' }} transition-all">FAQs</a>
                      <a href="{{ route('about', 'terms-condition') }}" class="px-2.5 py-1.5 text-gray-600 hover:text-gray-900 border-primary-500 {{ strtolower($content) == 'terms-condition' ? 'border-b-2' : '' }} transition-all">Terms & Condition</a>
                      <a href="{{ route('about', 'privacy') }}"  class="px-2.5 py-1.5 text-gray-600 hover:text-gray-900 border-primary-500 {{ strtolower($content) == 'privacy' ? 'border-b-2' : '' }} transition-all">Privacy</a>
                      <a href="{{ route('about', 'contact-us') }}"  class="px-2.5 py-1.5 text-gray-600 hover:text-gray-gray-900 border-primary-500 {{ strtolower($content) == 'contact-us' ? 'border-b-2' : '' }} transition-all">Contact Us</a>
                  </nav>

                  {{-- mobile dropdown --}}
                  <div x-data="{open: false}" class="md:hidden">
                    <button x-on:click="open = !open" class="md:hidden cursor-pointer">
                      <i class="fas fa-bars text-xl"></i>
                    </button>
                    <nav :class="open ? 'flex flex-col' : 'hidden'" class="md:hidden -translate-x-[calc(100%-1.25rem)] bg-gray-100 absolute rounded-sm divide-y border-gray-600 shadow-xl">
                        <a href="{{ route('about') }}" class="px-4 py-2.5 text-gray-600 hover:text-gray-900 {{ strtolower($content) == 'about' ? 'bg-primary-100' : '' }} transition-all">About</a>
                        <a href="{{ route('about', 'FAQs') }}" class="px-4 py-2.5 text-gray-600 hover:text-gray-900 {{ strtolower($content) == 'faqs' ? 'bg-primary-100' : '' }} transition-all">FAQs</a>
                        <a href="{{ route('about', 'terms-condition') }}" class="px-4 py-2.5 text-gray-600 hover:text-gray-900 {{ strtolower($content) == 'terms-condition' ? 'bg-primary-100' : '' }} transition-all">Terms & Condition</a>
                        <a href="{{ route('about', 'privacy') }}"  class="px-4 py-2.5 text-gray-600 hover:text-gray-900 {{ strtolower($content) == 'privacy' ? 'bg-primary-100' : '' }} transition-all">Privacy</a>
                        <a href="{{ route('about', 'contact-us') }}"  class="px-4 py-2.5 text-gray-600 hover:text-gray-gray-900 {{ strtolower($content) == 'contact-us' ? 'bg-primary-100' : '' }} transition-all whitespace-nowrap">Contact Us</a>
                    </nav>
                  </div>
              </div>
            </nav>

            <!-- Page Content -->
            <div class="h-full">
                {{ $slot }}
            </div>

            <footer class="bg-gray-800 text-white py-8">
                <div class="container mx-auto px-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div>
                            <a href="{{ route('home') }}"><h3 class="text-xl md:text-2xl font-bold mb-4">FaStore</h3></a>
                            <p class="text-gray-400">
                                Explore the intersection of technology and style.
                            </p>
                        </div>
                        
                        <div class="md:col-start-4">
                            <h4 class="font-semibold mb-4">Find us on social media</h4>
                            <div class="flex w-full justify-start items-center gap-x-8">
                                <a href="https://www.instagram.com/sabfatiih" class="hover:-translate-y-[1px] hover:text-primary-400 transition-all">
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

            @stack('scripts-body')
        </div>

    </body>
</html>
