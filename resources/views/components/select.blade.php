@props(['label' => null])
<div>
  @if ($label)
    <label for="{{ $attributes->get('id') }}" class="block text-sm font-medium text-gray-700 dark:text-white">
      {{ __($label) }}
    </label>
  @endif
  <select id="{{ $attributes->get('id') }}"
    {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}>
    {{ $slot }}
  </select>
</div>
