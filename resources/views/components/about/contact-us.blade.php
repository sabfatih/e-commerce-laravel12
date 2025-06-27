<x-layouts.about>
  <main class="h-fit pt-30 pb-20 md:pt-0 md:pb-0">
    <div class="mx-auto w-10/12 max-w-md h-fit rounded-md shadow-lg text-gray-800 px-6 py-4 my-0 md:my-20">
      <h1 class="text-center font-semibold text-2xl mb-6">Contact Us</h1>
      <form action="#" class="w-full">
        <div>
          <label for="email" class="block text-lg">Your Email</label>
          <input type="email" name="email" id="email" class="rounded-sm border-none w-full" required>
        </div>
        <div class="mt-4">
          <label for="message" class="block text-lg">Message</label>
          <textarea name="message" id="message" rows="10" class="rounded-sm border-none w-full" required></textarea>
        </div>

        <button type="submit" class="mt-6 w-full bg-primary-600 text-gray-100 rounded-md px-3 py-2 cursor-pointer hover:bg-primary-700 transition-all active:bg-primary-600">
          Send
        </button>
      </form>
    </div>
  </main>
</x-layouts.about>