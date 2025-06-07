<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Document</title>
</head>
<body class="min-h-screen">
  <section class="bg-white dark:bg-gray-900">
      <div class="container flex items-center justify-center min-h-screen px-6 mx-auto">
          <form action="/login" method="POST" class="w-full max-w-md">
              <h1 class="text-center mt-3 text-2xl font-semibold text-gray-800 capitalize sm:text-3xl dark:text-white">Sign Up</h1>

              <div class="space-y-4 mt-8">
                <div class="relative flex items-center">
                    <span class="absolute">
                        <i class="fa-regular fa-user w-6 h-6 mx-3 text-gray-300 dark:text-gray-500 text-xl text-center"></i>
                    </span>
  
                    <input type="text" class="block w-full py-3 text-gray-700 bg-white border rounded-lg px-11 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Username">
                </div>
  
                <div class="relative flex items-center">
                    <span class="absolute">
                        <i class="fa-regular fa-envelope w-6 h-6 mx-3 text-gray-300 dark:text-gray-500 text-xl text-center"></i>
                    </span>
  
                    <input type="email" class="block w-full py-3 text-gray-700 bg-white border rounded-lg px-11 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Email address">
                </div>
  
                <div class="relative flex items-center">
                    <span class="absolute">
                        <i class="fa-solid fa-lock w-6 h-6 mx-3 text-gray-300 dark:text-gray-500 text-xl text-center"></i>
                    </span>
  
                    <input type="password" class="block w-full px-10 py-3 text-gray-700 bg-white border rounded-lg dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Password">
                </div>
              </div>


              <div class="mt-6">
                  <button class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                      Sign Up
                  </button>

                  <p class="mt-4 text-center text-gray-600 dark:text-gray-400">or sign up with</p>

                  <a href="#" class="flex items-center justify-center px-6 py-3 mt-4 text-gray-600 transition-colors duration-300 transform border rounded-lg dark:border-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                      <svg class="w-6 h-6 mx-2" viewBox="0 0 40 40">
                          <path d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.045 27.2142 24.3525 30 20 30C14.4775 30 10 25.5225 10 20C10 14.4775 14.4775 9.99999 20 9.99999C22.5492 9.99999 24.8683 10.9617 26.6342 12.5325L31.3483 7.81833C28.3717 5.04416 24.39 3.33333 20 3.33333C10.7958 3.33333 3.33335 10.7958 3.33335 20C3.33335 29.2042 10.7958 36.6667 20 36.6667C29.2042 36.6667 36.6667 29.2042 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z" fill="#FFC107" />
                          <path d="M5.25497 12.2425L10.7308 16.2583C12.2125 12.59 15.8008 9.99999 20 9.99999C22.5491 9.99999 24.8683 10.9617 26.6341 12.5325L31.3483 7.81833C28.3716 5.04416 24.39 3.33333 20 3.33333C13.5983 3.33333 8.04663 6.94749 5.25497 12.2425Z" fill="#FF3D00" />
                          <path d="M20 36.6667C24.305 36.6667 28.2167 35.0192 31.1742 32.34L26.0159 27.975C24.3425 29.2425 22.2625 30 20 30C15.665 30 11.9842 27.2359 10.5975 23.3784L5.16254 27.5659C7.92087 32.9634 13.5225 36.6667 20 36.6667Z" fill="#4CAF50" />
                          <path d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.7592 25.1975 27.56 26.805 26.0133 27.9758C26.0142 27.975 26.015 27.975 26.0158 27.9742L31.1742 32.3392C30.8092 32.6708 36.6667 28.3333 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z" fill="#1976D2" />
                      </svg>
                      <span class="mx-2">Google</span>
                  </a>

                  <div class="mt-6 text-center text-gray-600 dark:text-gray-400">
                      <p class="text-sm">
                          Already have an account? <a href="/login" class="text-blue-500 hover:underline dark:text-blue-400">Sign in</a>
                      </p>
                  </div>
              </div>
          </form>
      </div>
  </section>

</body>
</html>