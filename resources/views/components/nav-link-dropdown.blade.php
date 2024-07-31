
@props(['active' => false, 'width' => '48', 'label' ])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5
text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
: 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500
dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700
focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700
transition duration-150 ease-in-out';
@endphp

<div class="relative {{ $classes }}"
x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
  <div @click="open = ! open">
    <button
      class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
      <div> {{ __($label) }} </div>

      <div class="ms-1">
        <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
          <path fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd" />
        </svg>
      </div>
    </button>
  </div>

  <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
    class="absolute flex-col z-50 mt-[40px] xl:mt-[60px]  w-{{ $width }} rounded-md shadow-lg "
    @click="open = false">
    <div class="absolute">
      <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white dark:bg-gray-700">
        {{ $content }}
      </div>
    </div>
  </div>
</div>
