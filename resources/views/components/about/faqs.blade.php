<x-layouts.about>
  <main class="container mx-auto pt-20 md:pt-4 mb-12 max-w-10/12 py-4 font-inter text-gray-800 space-y-4">
    <h1 class="text-2xl md:text-3xl font-bold">Frequently Asked Questions</h1>
    @foreach ($faqs as $question => $answer)
    <h2 class="font-semibold text-base md:text-lg m-0">Q: {{ $question }}</h2>
    <p class="ml-8">{!! nl2br(e($answer)) !!}</p>
    @endforeach
  </main>
</x-layouts.about>