@props(['active', 'label', 'itemsMenuDropdownButton'])

@php
$classes = ($active ?? false)
? 'block w-full pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50
focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150
ease-in-out'
: 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800
hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300
transition duration-150 ease-in-out';
@endphp

<div class="pl-4">
  <div class="{{ $classes }}">
    {{ __($label) }}
  </div>
  <div class="space-y-1">
    @foreach ($itemsMenuDropdownButton as $i)
    @can($i->permission)
    <a href="{{ route($i->route) }}"
      class="block w-full pl-6 pr-4 py-2 border-l-4 text-sm text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
      {{ __($i->label) }}
    </a>
    @endcan
    @endforeach
  </div>
</div>
