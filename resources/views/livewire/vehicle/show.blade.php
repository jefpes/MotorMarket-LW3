<div>
  <x-slot name="header">{{ __($header) }}: <span class="text-yellow-300">{{ $vehicle->plate ?? 'Vehicle'}}</span></x-slot>

      <div class="flex overflow-x-auto pb-4">
        @forelse ($vehicle->photos as $photo)
          <img wire:click="actions({{ $photo->id }})" class="cursor-pointer w-full md:max-w-sm mx-auto max-h-[60vh]" src="../{{ $photo->path }}">
        @empty
          <p class="text-center text-2xl text-red-400" >{{ __('No photo available') }}</p>
        @endforelse
      </div>
  <div class="p-2 border-t border-gray-200 dark:border-gray-700">
    <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{  __('Purchase Date') }}: </span> <x-span-date :date="$vehicle->purchase_date" /> </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Purchase Price') }}: </span> <x-span-money class="py-4" :money="$vehicle->purchase_price" /> </p>
      </div>
      @if ($vehicle->expenses)
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Expense') }}: </span> <x-span-money class="py-4" :money="$vehicle->expenses->sum('value')" /> </p>
      </div>
      @endif
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
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('KM') }}: </span> {{ $vehicle->km }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Color') }}: </span> {{ $vehicle->color }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Plate') }}: </span> {{ $vehicle->plate }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Chassi') }}: </span> {{ $vehicle->chassi }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Renavan') }}: </span> {{ $vehicle->renavan }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Description') }}: </span> {{ $vehicle->description }} </p>
      </div>
    </dl>
  </div>
  <div class="flex pt-4 items-center border-t border-gray-200 rounded-b dark:border-gray-600 justify-end gap-x-2">
    @can('expense_create')
      <livewire:vehicle-expense.create v_id="{{ $vehicle->id }}"/>
    @endcan
    <x-secondary-button :href="route('vehicle')" wire:navigate> {{ __('Back') }} </x-secondary-button>
    @can('vehicle_update')
      <x-primary-button :href="route('vehicle.edit', $vehicle->id)" wire:navigate> {{ __('Edit') }} </x-primary-button>
    @endcan
  </div>

  <x-modal wire:model="modal" name="modal">
    <x-slot:title> {{ __('Options') }} </x-slot:title>
    <div class="w-full">
      <p> {{__('Select action wished.')}} </p>
    </div>

    <x-slot:footer>
      <x-secondary-button wire:click="cancel">
        {{ __('Back') }}
      </x-secondary-button>

      <x-primary-button wire:click="download" class="ms-3">
        {{ __('Download') }}
      </x-primary-button>

      @can('vphoto_delete')
        <x-danger-button wire:click="destroy" class="ms-3">
          {{ __('Delete') }}
        </x-danger-button>
      @endcan
    </x-slot:footer>
  </x-modal>

  <x-toast on="show-toast" :$icon>
    {{ __($msg) }}
  </x-toast>
</div>
