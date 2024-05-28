<div>
  <x-slot name="header">{{ __($header) }}</x-slot>
  <div class="flex flex-col md:flex-row justify-between gap-2 pb-3">
    <div class="flex-1">
      <x-form.input name="search" type="text" placeholder="Search" :messages="$errors->get('search')"
        wire:model.live.debounce.800="search" class="w-full" />
    </div>
    <div class="flex-0 sm:flex gap-2">
      <div class="flex-none justify-between">
        <x-text-input type="date" id="date_i" wire:model.live='date_i' /> {{ __('to') }} <x-text-input type="date" id="date_f" wire:model.live='date_f' />
      </div>

      <x-select wire:model.live="vehicle_type_id" class="w-full" id="type_select">
        <option value=""> {{ __('Type')}} </option>
        @foreach ($types as $data)
        <option value="{{ $data->id }}"> {{ $data->name }} </option>
        @endforeach
      </x-select>
      <x-select wire:model.live="vehicle_model_id" class="w-full" id="model_select">
        <option value=""> {{ __('Model') }} </option>
        @foreach ($models as $data)
        <option value="{{ $data->id }}"> {{ $data->name }} </option>
        @endforeach
      </x-select>
      @can('vehicle_create')
        <x-primary-button :href="route('vehicle.create')"  wire:navigate > {{ __('New') }} </x-primary-button>
      @endcan
    </div>
  </div>

  <div class="flex flex-wrap mx-auto gap-2">
    @foreach ($this->vehicle as $v)
      <livewire:vehicle.card :vehicle="$v" :key="$v->id">
    @endforeach
  </div>

  <div class="mt-4"> {{ $this->vehicle->links() }} </div>
</div>
