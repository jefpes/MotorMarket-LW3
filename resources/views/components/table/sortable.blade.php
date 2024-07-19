<div {{ $attributes->merge(['class'=> 'flex items-center']) }}>
  {{ __($columnLabel) }}

  @if ($sortColumn !== $columnName)
    <x-icons.up-down class="ml-2"/>
  @elseif ($sortDirection === 'asc')
    <x-icons.down class="ml-2"/>
  @else
    <x-icons.up class="ml-2"/>
  @endif
</div>
