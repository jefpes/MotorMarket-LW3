@props(['active', 'label', 'menuIconsDropdownButton', 'megaMenuIconsDropdown', 'itemsMenuDropdownButton'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5
text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
: 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500
dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700
focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700
transition duration-150 ease-in-out';

// Verifica se há pelo menos um item filho visível
$hasVisibleChildren = collect($itemsMenuDropdownButton)->some(fn($item) => auth()->user()->can($item->permission));
@endphp

@if ($hasVisibleChildren)
<li class="{{ $classes }}">
  <button id="{{ $menuIconsDropdownButton }}" data-dropdown-toggle="{{ $megaMenuIconsDropdown }}">
    {{ __($label) }}
  </button>
  <div id="{{ $megaMenuIconsDropdown }}"
    class="absolute z-10 hidden w-auto text-sm bg-white border border-gray-100 rounded-lg shadow-md dark:border-gray-700 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800">
    <div class="p-4 pb-0 text-gray-900 md:pb-4 dark:text-white">
      <ul class="space-y-4" aria-labelledby="{{ $menuIconsDropdownButton }}">
        @foreach ($itemsMenuDropdownButton as $i)
        @can($i->permission)
        <li>
          <a href="{{ route($i->route) }}"
            class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group">
            <span class="sr-only">{{ __($i->label) }}</span> {{ __($i->label) }}
          </a>
        </li>
        @endcan
        @endforeach
      </ul>
    </div>
  </div>
</li>
@endif
