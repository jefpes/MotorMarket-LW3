@props(['name', 'label' => null,'messages', 'placeholder' => null])

<div>
  @if ($label)
  <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">
    {{ __($label) }}
  </label>
  @endif
  <div class="flex">
    <span
      class="inline-flex items-center px-3 text-sm font-semibold tracking-[0.10rem] text-gray-900 bg-gray-300 dark:bg-gray-700 border rounded-e-0 border-gray-300 border-e-0 rounded-s-md dark:text-gray-400 dark:border-gray-600">
      <span class="w-4 h-4 text-gray-700 dark:text-gray-300"> R$ </span>
    </span>
    <input x-mask:dynamic="$money($input, ',', '')" name="{{ $name }}" placeholder="{{ __($placeholder) }}" type="text"
      {{ $attributes->merge(['class' => 'tracking-[0.20rem] rounded-none rounded-e-lg dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 border-gray-300 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}>
  </div>
</div>
