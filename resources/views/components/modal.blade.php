@props([
'name',
'title' => null,
'footer' => null,
])

<div x-data="{
    @if($attributes->wire('model')->value())
        show: @entangle($attributes->wire('model')->value()),
    @endif
    }" x-on:open-modal.window="show = ($event.detail.name === {{$name}})"
  x-on:close-modal.window="show = !($event.detail.name === {{$name}})" x-on:click.away="show = false"
  x-on:keydown.escape.window="show = false" x-transition:enter="ease-out duration-300"
  x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
  x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-show="show"
  class="fixed inset-0 z-20 p-4 everflow" style="display: none;">
  <div x-on:click="show = false" class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"
    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 aria-hidden=" true">
  </div>

  <div
    class="mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full max-w-2xl mx-auto">
    @if ($title)
    <div class="flex items-center justify-center p-4 border-b rounded-t dark:border-gray-600">
      <h1 class="text-xl text-center font-semibold text-gray-900 dark:text-white">
        {{$title}}
      </h1>
    </div>
    @endif

    <div class="p-5">
      {{$slot}}
    </div>

    @if ($footer)
    <div class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600 justify-end">
      {{$footer}}
    </div>
    @endif

  </div>
</div>
