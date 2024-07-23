<div>
  <x-slot:header> {{ __($header) }} </x-slot:header>
  @can($permission::VEHICLE_TYPE_CREATE->value)
    <div class="flex justify-end pb-4">
      <x-primary-button type='button' wire:click="$dispatch('vtype::creating')" class="text-[1em] tracking-normal"> {{ __('New') }} </x-primary-button>
    </div>
  @endcan
  <div>
    <x-table.table>
      <x-slot:thead>
        @foreach ($this->table as $h)
          @if ($h->field == 'actions')
            @canany([$permission::VEHICLE_TYPE_UPDATE->value, $permission::VEHICLE_TYPE_DELETE->value])
              <x-table.th> {{ __($h->head) }} </x-table.th>
            @endcanany
          @else
            <x-table.th class="cursor-pointer" wire:click="doSort('{{ $h->field }}')">
              <x-table.sortable :columnLabel="$h->head" :columnName='$h->field' :sortColumn="$sortColumn" :sortDirection="$sortDirection" />
            </x-table.th>
          @endif
        @endforeach

      </x-slot:thead>
      <x-slot:tbody>
        @foreach ($this->data as $d)
          <x-table.tr>
            <x-table.td> {{ $d->name }} </x-table.td>
            @canany([$permission::VEHICLE_TYPE_UPDATE->value, $permission::VEHICLE_TYPE_DELETE->value])
              <x-table.td>
                <div class="flex flex-row gap-2 justify-center">
                  @can($permission::VEHICLE_TYPE_UPDATE->value)
                    <x-icons.edit wire:click="$dispatch('vtype::editing', { id: {{ $d->id }} })" class="cursor-pointer flex text-yellow-400 w-8 h-8" />
                  @endcan
                  @can($permission::VEHICLE_TYPE_DELETE->value)
                    <x-icons.delete wire:click="$dispatch('vtype::deleting', { id: {{ $d->id }} })" class="cursor-pointer flex text-red-500 w-8 h-8" />
                  @endcan
                </div>
              </x-table.td>
            @endcanany
          </x-table.tr>
        @endforeach
      </x-slot:tbody>
    </x-table.table>
  </div>

  <livewire:vehicle-type.create />
  <livewire:vehicle-type.update />
  <livewire:vehicle-type.delete />
</div>
