<div>
    <x-slot name="header">{{ __($header) }}</x-slot>

    <div class="flex flex-col md:flex-row gap-2 pb-3 flex-0 sm:flex justify-between">
      <div class="flex flex-col md:flex-row gap-2 flex-0 sm:flex">
        <div class="flex-none">
          <x-input-label for="date_i" value="{{ __('Date') }}" />
          <x-text-input type="date" id="date_i" wire:model.live.debounce.500ms='date_i' />
          {{ __('to') }}
          <x-text-input type="date" id="date_f" wire:model.live.debounce.500ms='date_f' />
        </div>
      </div>

      <div class="flex justify-end gap-2">
        <div>
          <x-input-label for="perPage" value="{{ __('Nº') }}" />
          <x-select wire:model.live="perPage" class="w-full" id="perPage">
            <option value="10"> 10 </option>
            <option value="15"> 15 </option>
            <option value="25"> 25 </option>
            <option value="50"> 50 </option>
            <option value="100"> 100 </option>
          </x-select>
        </div>
      </div>
    </div>

    <x-table.table>
      <x-slot:thead>
        @foreach ($theader as $h)
        @if ($h == 'Actions')
        @canany(['expense_update', 'expense_delete'])
        <x-table.th> {{ __($h) }} </x-table.th>
        @endcanany
        @else
        <x-table.th> {{ __($h) }} </x-table.th>
        @endif
        @endforeach
      </x-slot:thead>
      <x-slot:tbody>
        @foreach ($this->expenses as $data)
        <x-table.tr>
          <x-table.td> {{ $data->vehicle->plate }} </x-table.td>
          <x-table.td> {{ $data->value }} </x-table.td>
          <x-table.td> {{ $data->description }} </x-table.td>
          <x-table.td> {{ $data->date }} </x-table.td>
          <x-table.td> {{ $data->user->name ?? '' }} </x-table.td>

          @canany(['expense_update', 'expense_delete'])
          <x-table.td>
            <div class="flex flex-row gap-2">
              <x-icons.edit id="btn-edit-{{ $data->id }}" wire:click="$dispatch('expense::editing', { id: {{ $data->id }} })" class="cursor-pointer flex text-yellow-400 w-8 h-8" />

              <x-icons.delete id="btn-delete-{{ $data->id }}" wire:click="$dispatch('expense::deleting', { id: {{ $data->id }} })" class="cursor-pointer flex text-red-500 w-8 h-8" />
            </div>
          </x-table.td>
          @endcanany
        </x-table.tr>
        @endforeach
      </x-slot:tbody>
    </x-table.table>
    <div class="pt-6 px-2">
      {{ $this->expenses->onEachSide(1)->links() }}
    </div>
</div>
