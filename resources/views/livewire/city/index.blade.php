<div>
  <x-slot:header> {{ __($header) }} </x-slot:header>
  @can($this->permissions->create)
    <div class="flex justify-end pb-4">
      <livewire:city.create/>
    </div>
  @endcan
  <div>
    <x-table.table>
      <x-slot:thead>
        @foreach ($thead as $h)
          @if ($h == 'Actions')
            @canany([$this->permissions->update, $this->permissions->delete])
              <x-table.th> {{ __($h) }} </x-table.th>
            @endcanany
          @else <x-table.th> {{ __($h) }} </x-table.th> @endif
        @endforeach
      </x-slot:thead>
      <x-slot:tbody>
        @foreach ($this->data as $d)
          <x-table.tr>
            <x-table.td> {{ $d->name }} </x-table.td>
            @canany([$this->permissions->update, $this->permissions->delete])
              <x-table.td>
                <div class="flex flex-row gap-2 justify-center">
                  @can($this->permissions->update)
                    <x-icons.edit wire:click="$dispatch('city::editing', { id: {{ $d->id }} })" class="cursor-pointer flex text-yellow-400 w-8 h-8" />
                  @endcan
                  @can($this->permissions->delete)
                    <x-icons.delete wire:click="$dispatch('city::deleting', { id: {{ $d->id }} })" class="cursor-pointer flex text-red-500 w-8 h-8" />
                  @endcan
                </div>
              </x-table.td>
            @endcanany
          </x-table.tr>
        @endforeach
      </x-slot:tbody>
    </x-table.table>
  </div>

  <livewire:city.update />
  <livewire:city.delete />
</div>
