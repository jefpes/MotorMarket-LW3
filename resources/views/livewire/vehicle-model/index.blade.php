<div>
  <x-slot:header> {{ __($header) }} </x-slot:header>

  <div class="flex flex-row flex-wrap md:flex-nowrap w-full mb-4 gap-x-2 gap-y-2">
    <div class="w-full flex-1">
      <x-form.input name="search" type="text" placeholder="Search" :messages="$errors->get('search')"
        wire:model.live.debounce.800="search" class="w-full" />
    </div>
    <div class="gap-2 flex flex-0">
      <x-select wire:model.live="brand_id" class="w-full" id="brand_select">
        <option value=""> {{ __('Select a Brand')}} </option>
          @foreach ($brands as $data)
            <option value="{{ $data->id }}"> {{ $data->name }} </option>
          @endforeach
      </x-select>
      <x-select wire:model.live="vehicle_type_id" class="w-full" id="type_select">
        <option value=""> {{ __('Select a Type')}} </option>
          @foreach ($types as $data)
            <option value="{{ $data->id }}"> {{ $data->name }} </option>
          @endforeach
      </x-select>
      @can($permission::VEHICLE_MODEL_CREATE->value)
        <livewire:vehicle-model.create>
      @endcan
    </div>
  </div>

  <div>
    <x-table.table>
      <x-slot:thead>
        @foreach ($thead as $h)
          @if ($h == 'actions')
            @canany([$permission::VEHICLE_MODEL_UPDATE->value, $permission::VEHICLE_MODEL_DELETE->value])
              <x-table.th> {{ __($h) }} </x-table.th>
            @endcanany
          @else
            <x-table.th> {{ __($h)}} </x-table.th>
          @endif
        @endforeach
      </x-slot:thead>
      <x-slot:tbody>
        @forelse ($this->vmodels as $vm)
          <x-table.tr wire:key="{{ $vm->id }}">
            <x-table.td> {{ $vm->name }} </x-table.td>
            <x-table.td> {{ $vm->brand->name }} </x-table.td>
            <x-table.td> {{ $vm->type->name }} </x-table.td>
            @canany([$permission::VEHICLE_MODEL_UPDATE->value, $permission::VEHICLE_MODEL_DELETE->value])
              <x-table.td>
                <div class="flex flex-row gap-2 justify-center">
                  @can($permission::VEHICLE_MODEL_UPDATE->value)
                    <x-icons.edit id="btn-edit-{{ $vm->id }}" wire:click="$dispatch('vmodel::editing', { id: {{ $vm->id }} })" class="cursor-pointer flex text-yellow-400 w-8 h-8" />
                  @endcan
                  @can($permission::VEHICLE_MODEL_DELETE->value)
                    <x-icons.delete id="btn-delete-{{ $vm->id }}" wire:click="$dispatch('vmodel::deleting', { id: {{ $vm->id }} })" class="cursor-pointer flex text-red-500 w-8 h-8" />
                  @endcan
                </div>
              </x-table.td>
            @endcanany
          </x-table.tr>
        @empty
          <x-table.tr-no-register :cols="count($theader)" />
        @endforelse
      </x-slot:tbody>
    </x-table.table>
  </div>
  <livewire:vehicle-model.delete />
  <livewire:vehicle-model.edit />
</div>
