<div>
    <x-slot name="header">{{ __($header) }}</x-slot>

    <x-modal wire:model="modal" name="filter_modal">
      <x-slot:title> {{ __('Filters') }} </x-slot:title>
      <div class="space-y-2">
        <div class="flex gap-x-1">
          <div class="flex-1">
            <x-form.input class="w-full" label="Expense date after" type="date" name="date_i" wire:model.live.debounce.500ms='date_i' />
          </div>

          <div class="flex-1">
            <x-form.input class="w-full" label="Expense date before" type="date" name="date_e" wire:model.live.debounce.500ms='date_e' />
          </div>
        </div>

        <div class="flex gap-x-2">
          <div class="flex-1">
            <x-select label="Registers per page" wire:model.live="perPage" class="w-full" id="perPage">
              <option value="10"> 10 </option>
              <option value="15"> 15 </option>
              <option value="25"> 25 </option>
              <option value="50"> 50 </option>
              <option value="100"> 100 </option>
            </x-select>
          </div>
        </div>
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

    <div class="flex justify-between gap-2 pb-3">
      <div class="flex-1">
        <x-form.plate-input name="search" label="Plate" placeholder="Search" wire:model.live.debounce.800="plate" class="w-full" />
      </div>
      <div class="flex items-end gap-x-4 pb-1">
        <x-icons.filter
          class="cursor-pointer w-8 h-8 text-gray-800 hover:text-blue-500 dark:text-gray-200 dark:hover:text-blue-500"
          wire:click="$set('modal', true)" />
      </div>
    </div>

    <x-table.table>
      <x-slot:thead>
        @foreach ($this->table as $h)
          @if ($h->field == 'actions')
            @canany([$this->permission->update, $this->permission->delete])
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
        @forelse ($this->expenses as $data)
        <x-table.tr>
          <x-table.td> {{ $data->vehicle->plate }} </x-table.td>
          <x-table.td> <x-span-money :money="$data->value" /> </x-table.td>
          <x-table.td> {{ $data->description }} </x-table.td>
          <x-table.td> <x-span-date :date="$data->date" /> </x-table.td>
          <x-table.td> {{ $data->name ?? '' }} </x-table.td>

          @canany([$this->permission->update, $this->permission->delete])
          <x-table.td>
            <div class="flex flex-row gap-2">
              <x-icons.edit id="btn-edit-{{ $data->id }}" wire:click="$dispatch('expense::editing', { id: {{ $data->id }} })" class="cursor-pointer flex text-yellow-400 w-8 h-8" />

              <x-icons.delete id="btn-delete-{{ $data->id }}" wire:click="$dispatch('expense::deleting', { id: {{ $data->id }} })" class="cursor-pointer flex text-red-500 w-8 h-8" />
            </div>
          </x-table.td>
          @endcanany
        </x-table.tr>
        @empty
          <x-table.tr-no-register :cols="count($theader)" />
        @endforelse
      </x-slot:tbody>
    </x-table.table>
    <div class="pt-6 px-2">
      {{ $this->expenses->onEachSide(1)->links() }}
    </div>

    <livewire:vehicle-expense.edit>
    <livewire:vehicle-expense.delete>
</div>
