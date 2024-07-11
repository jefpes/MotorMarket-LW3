@props(['icon' => 'icons.success', 'msg' => 'Saved'])
<div x-data="{ shown: false, timeout: null }"
  x-init="@this.on('show-toast', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); })"
  x-show.transition.out.opacity.duration.1500ms="shown" x-transition:leave.opacity.duration.1500ms
  style="display: none;" {{ $attributes->merge(['class' => 'fixed flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x
  rtl:divide-x-reverse  divide-gray-200 rounded-lg shadow right-5 bottom-5 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800']) }}>
  <x-dynamic-component :component="$icon" class="mr-4" />
  {{ __($msg) }}
</div>
