@props(['name', 'label','messages', 'placeholder' => null, 'rows' => '4'])

<div>
  <label class ='block font-medium text-sm text-gray-700 dark:text-gray-300'>
    {{ __($label) }}
  </label>
  <textarea
    name="{{ $name }}"
    placeholder="{{ __($placeholder) }}"
    rows="{{ $rows }}"
    {{ $attributes->merge(['class' => 'block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500
    focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}></textarea>

  @if ($messages)
  <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
    @foreach ((array) $messages as $message)
    <li>{{ $message }}</li>
    @endforeach
  </ul>
  @endif
</div>
