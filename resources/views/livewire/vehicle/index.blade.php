<div>
  <x-slot name="header">{{ __($header) }}</x-slot>
  <div class="flex justify-between gap-2 pb-3">
    <div class="flex-1">
      <x-form.plate-input type="search" label="Plate" name="search" placeholder="Search" :messages="$errors->get('search')"
        wire:model.live.debounce.800="search" class="w-full" />
    </div>
    <div class="flex items-center">
      <div class="flex gap-x-4">
        <x-icons.filter class="cursor-pointer w-6 h-6 text-gray-800 hover:text-blue-500 dark:text-gray-200 dark:hover:text-blue-500" wire:click="$set('modal', true)"/>

        @can('vehicle_create')
        <x-primary-button :href="route('vehicle.create')"  wire:navigate > {{ __('New') }} </x-primary-button>
        @endcan
      </div>
    </div>
  </div>

  <div class="flex flex-wrap mx-auto gap-2">
    @forelse ($this->vehicle as $v)
      <livewire:vehicle.card :vehicle="$v" :key="$v->id">
    @empty
      <div class="w-full text-center text-4xl"> {{ __('No records found') }} </div>
    @endforelse
  </div>

  <div class="mt-4"> {{ $this->vehicle->links() }} </div>

  <x-modal wire:model="modal" name="main_modal">
    <x-slot:title> {{ __('Filters') }} </x-slot:title>
    <div class="space-y-4">
      <div class="flex gap-x-2">
        <x-form.input label="Buyed after of" type="date" name="date_i" wire:model.live='date_i' />

        <x-form.input label="Buyed after of" type="date" name="date_f" wire:model.live='date_f' />
      </div>
      <x-select label="Sold" wire:model.live="sold" class="w-full" id="sold">
        <option value="0"> {{ __('Unsold') }} </option>
        <option value="true"> {{ __('Sold') }} </option>
      </x-select>

      <x-select label="Type" wire:model.live="vehicle_type_id" class="w-full" id="type_select">
        <option value=""> {{ __('Type')}} </option>
        @foreach ($types as $data)
          <option value="{{ $data->id }}"> {{ $data->name }} </option>
        @endforeach
      </x-select>

      <x-select label="Brand" wire:model.live="brand_id" class="w-full" id="brand_select">
        <option value=""> {{ __('Type')}} </option>
        @foreach ($this->brands as $data)
        <option value="{{ $data->id }}"> {{ $data->name }} </option>
        @endforeach
      </x-select>

      <x-select label="Model" wire:model.live="vehicle_model_id" class="w-full" id="model_select">
        <option value=""> {{ __('Model') }} </option>
        @foreach ($this->models as $data)
        <option value="{{ $data->id }}"> {{ $data->name }} </option>
        @endforeach
      </x-select>
    </div>

    <x-slot:footer>
      <x-secondary-button type="button" wire:click="$set('modal', false)">
        {{ __('Close') }}
      </x-secondary-button>

      <x-primary-button class="ms-3" type="button" wire:click="resetFilters">
        {{ __('Reset Filter') }}
      </x-primary-button>
    </x-slot:footer>
  </x-modal>
</div>
