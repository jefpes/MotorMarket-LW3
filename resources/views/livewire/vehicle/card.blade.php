<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
  <a href="{{ route('vehicle.show', $vehicle->id) }}" wire:navigate>
    @if ($vehicle->photos()->first() && Storage::exists("/vehicle_photos/".$vehicle->photos()->first()->photo_name))
      <img class="rounded-t-lg max-h-72" src="{{ $vehicle->photos()->first()->path }}" alt="{{ $vehicle->surname }}"/>
      @else
      <x-icons.no-image class="w-full h-72" />
    @endif
  </a>
  <div class="p-2">
    <div class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Purchase Date') }}: </span> <x-span-date :date="$vehicle->purchase_date" /> </p>
      </div>
      @can('vehicle_create')
        <div class="flex">
          <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Purchase Price') }}: </span> <x-span-money class="py-4" :money="$vehicle->purchase_price" /> </p>
        </div>
      @endcan
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Expense') }}: </span> <x-span-money class="py-4" :money="$vehicle->expenses->sum('value')" /> </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Sale Price') }}: </span> <x-span-money class="py-4" :money="$vehicle->sale_price" /> </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Type') }}: </span> {{ $vehicle->model->type->name ?? '' }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Brand') }}: </span> {{ $vehicle->model->brand->name ?? '' }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Model') }}: </span> {{ $vehicle->model->name ?? '' }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Year') }}: </span> {{ $vehicle->year_one .'/'. $vehicle->year_two }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('KM') }}: </span> {{ $vehicle->km ?? 0 }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Color') }}: </span> {{ $vehicle->color }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Plate') }}: </span> {{ $vehicle->plate }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Description') }}: </span> {{ $vehicle->description }} </p>
      </div>
    </div>
  </div>
  @canany(['vehicle_update', 'vehicle_delete'])
    <div class="flex flex-wrap gap-y-2 items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600 justify-end gap-x-2">
      @can('vexpense_create')
        <livewire:vehicle-expense.create v_id="{{ $vehicle->id }}" wire:key="expense_{{ $vehicle->id }}" />
      @endcan

      @can('vehicle_update')
        <x-secondary-button :href="route('vehicle.edit', $vehicle->id)" wire:navigate> {{ __('Edit') }} </x-secondary-button>
      @endcan

      @can('vehicle_delete')
        <livewire:vehicle.delete :id="$vehicle->id" wire:key="delete_{{ $vehicle->id }}" />
      @endcan

      @if(!$vehicle->sold_date)
        @can('sale_create')
          <x-primary-button :href="route('sale.create', $vehicle->id)" wire:navigate>{{ __('Sell') }}</x-primary-button>
        @endcan
      @endif

    </div>
  @endcanany
</div>
