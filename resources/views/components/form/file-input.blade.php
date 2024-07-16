@props(['name', 'label','messages' => null])

<div>
  <label for="{{ $name }}" class='block font-medium text-sm text-gray-700 dark:text-gray-300'>
    {{ __($label) }}
  </label>
  <input
    name="{{ $name }}"
    id="{{ $name }}"
    type="file"
    multiple
    {{ $attributes->merge(['class' => 'block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400
    focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400']) }}>

  @if ($messages)
  <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
    @foreach ((array) $messages as $message)
    <li>{{ $message }}</li>
    @endforeach
  </ul>
  @endif
</div>
