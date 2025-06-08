<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

          @php
            // Ambil route name saat ini
            $routeName = request()->route()->getName();
            // Default title
            $title = 'My Application';
            // Set title berdasarkan route name
            switch ($routeName) {
              case 'login':
                  $title = 'Login';
                  break;
              case 'register':
                  $title = 'Register';
                  break;
              case 'password.request':
                  $title = 'Forgot Password';
                  break;
              case 'password.reset':
                  $title = 'Reset Password';
                  break;
              case 'verification.notice':
                  $title = 'Verify Email';
                  break;
              case 'verification.verify':
                  $title = 'Verify Email';
                  break;
              case 'password.confirm':
                  $title = 'Confirm Password';
                  break;
              default:
                  // Bisa ditambah case lain sesuai kebutuhan
                  break;
            }
          @endphp
            <h1 class="text-5xl text-center tracking-widest text-primary-500 font-inter font-bold">{{ $title }}</h1>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
