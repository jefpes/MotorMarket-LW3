@props(['name', 'label' => null,'messages', 'placeholder' => null, 'type' => 'text'])

<div>
  @if ($label)
  <label class='block font-medium text-sm text-gray-700 dark:text-gray-300'>
    {{ __($label) }}
  </label>
  @endif
  <input x-mask="999.999.999-99" name="{{ $name }}" id="{{ $name }}" placeholder="{{ __($placeholder) }}"
    type="{{ $type }}" {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900
  dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600
  focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }}>

  @if ($messages)
  <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
    @foreach ((array) $messages as $message)
    <li>{{ $message }}</li>
    @endforeach
  </ul>
  @endif
</div>
