<div>
  <x-slot name="header">{{ __($header) }}</x-slot>
  <div class="flex flex-row flex-wrap md:flex-nowrap w-full mb-4 gap-x-2 gap-y-2">
    <div class="w-full flex-1">
      <x-form.input name="search" type="text" placeholder="Search" :messages="$errors->get('search')"
        wire:model.live.debounce.800="search" class="w-full" />
    </div>

    @can('vehicle_create')
    <div class="gap-2 flex flex-0">
        <x-select wire:model.live="vehicle_type_id" class="w-full" id="type_select">
          <option value=""> {{ __('Type')}} </option>
          @foreach ($types as $data)
          <option value="{{ $data->id }}"> {{ $data->name }} </option>
          @endforeach
        </x-select>
        <x-select wire:model.live="vehicle_model_id" class="w-full" id="model_select">
          <option value=""> {{ __('Model')}} </option>
          @foreach ($models as $data)
          <option value="{{ $data->id }}"> {{ $data->name }} </option>
          @endforeach
        </x-select>
      <x-primary-button :href="route('vehicle.create')"  wire:navigate > {{ __('New') }} </x-primary-button>
    </div>
    @endcan

  </div>

  <div class="flex flex-wrap mx-auto gap-2">
    @foreach ($this->vehicle as $v)
      <livewire:vehicle.card :vehicle="$v" :key="$v->id">
    @endforeach
  </div>

  <div class="mt-4"> {{ $this->vehicle->links() }} </div>
</div>
