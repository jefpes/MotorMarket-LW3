@props(['active' => false, 'align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white dark:bg-gray-700'])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'ltr:origin-top-left rtl:origin-top-right start-0';
        break;
    case 'top':
        $alignmentClasses = 'origin-top';
        break;
    case 'right':
    default:
        $alignmentClasses = 'ltr:origin-top-right rtl:origin-top-left end-0';
        break;
}

switch ($width) {
    case '48':
        $width = 'w-48';
        break;
}
@endphp

<div class="relative inline-flex items-center px-1 pt-1 border-b-2 {{ $active ? 'border-indigo-400 dark:border-indigo-600' : 'border-transparent' }} text-sm font-medium leading-5 {{ $active ? 'text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }} hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition duration-150 ease-in-out" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open" >
        {{ $trigger }}
    </div>

    <div x-show="open"
         class="absolute z-50 mt-20 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }} "
         style="display: none;"
         @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
