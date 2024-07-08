@props(['cols'])
<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
  <td colspan="{{ $cols }}" {{ $attributes->merge(['class' => 'px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center text-4xl']) }}>
      {{ __('No records found') }}
  </td>
</tr>
