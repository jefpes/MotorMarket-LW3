<div>
  <x-slot:header> {{ __('Roles') }} </x-slot:header>

  @can($permission::ADMIN->value)
    <div class="flex justify-end pb-4">
        <x-primary-button type='button' wire:click="$dispatch('role::creating')" class="text-[1em] tracking-normal"> {{ __('New Role') }} </x-primary-button>
    </div>
  @endcan

  <div>
    <x-table.table>
      <x-slot:thead>
        @foreach ($this->table as $h)
          @if ($h->field == 'actions')
            <x-table.th> {{ __($h->head) }} </x-table.th>
          @else
            <x-table.th class="cursor-pointer" wire:click="doSort('{{ $h->field }}')">
              <x-table.sortable :columnLabel="$h->head" :columnName="$h->field" :sortColumn="$sortColumn" :sortDirection="$sortDirection" />
            </x-table.th>
          @endif
        @endforeach
      </x-slot:thead>
      <x-slot:tbody>
        @foreach ($this->roles as $r)
        <x-table.tr wire:key="{{ $r->id }}">
          <x-table.td> {{ $r->name }} </x-table.td>
          <x-table.td> {{ $r->hierarchy }} </x-table.td>
          <x-table.td>
            @can($permission::ADMIN->value)
              @if (auth()->user()->roles()->pluck('hierarchy')->max() <= $r->hierarchy)
                <div class="flex flex-row gap-2 justify-center">
                  <x-icons.edit id="btn-edit-{{ $r->id }}" wire:click="$dispatch('role::editing', { id: {{ $r->id }} })" class="cursor-pointer flex text-yellow-400 w-8 h-8" />

                  <x-icons.shield id="ability_role_button_{{ $r->id }}" :href="route('ability.role', $r->id)" class="cursor-pointer flex text-green-600 w-8 h-8" wire:navigate />

                  <x-icons.delete id="btn-delete-{{ $r->id }}" wire:click="$dispatch('role::deleting', { id: {{ $r->id }} })" class="cursor-pointer flex text-red-500 w-8 h-8" />
                </div>
              @endif
            @endcan
          </x-table.td>
        </x-table.tr>
        @endforeach
      </x-slot:tbody>
    </x-table.table>
  </div>

  <livewire:role.create />
  <livewire:role.update />
  <livewire:role.delete />
</div>
