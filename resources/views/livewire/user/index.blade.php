<div>
  <x-slot name="header"> {{ __('Users') }} </x-slot>
  <div class="pb-4 flex flex-col md:flex-row justify-between gap-y-4 md:gap-y-0">
    <div class="w-full md:7/12 lg:w-7/12">
      <x-text-input class="w-full" type="search" name="search" wire:model.live.debounce.1000ms="search"
        placeholder="Pesquisar...">
      </x-text-input>
    </div>
    <div class="w-full md:5/12 lg:w-5/12 flex justify-end gap-x-2">
      @can($permission::USER_CREATE->value)
        <livewire:user.create />
      @endcan

      <x-select wire:model.live="perPage" class="flex">
        <option :value="10">10</option>
        <option :value="15">15</option>
        <option :value="25">25</option>
        <option :value="50">50</option>
      </x-select>
    </div>
  </div>


  <x-table.table>
    <x-slot:thead>
      @foreach ($this->table as $h)
          @if ($h->field == 'actions')
            @canany([$permission::VEHICLE_EXPENSE_UPDATE->value, $permission::VEHICLE_EXPENSE_DELETE->value])
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
      @forelse ($this->users->items() as $u)
      <x-table.tr>
        <x-table.td> {{ $u->name }} </x-table.td>
        <x-table.td> {{ $u->email }} </x-table.td>
        <x-table.td> <span
          class="{{ $u->deleted_at ? 'bg-red-100 text-red-800 me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300'
            : 'bg-green-100 text-green-800 me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300'}}"> {{ $u->deleted_at ? __('Inactive') : __('Active') }} </span> </x-table.td>
        @canany([$permission::USER_DELETE->value, $permission::USER_UPDATE->value, $permission::ADMIN->value])
          <x-table.td>
            @if(auth()->user()->hierarchy($u->id))
              <div class="flex flex-row gap-2 justify-center">
                @if (!$u->deleted_at)
                  @can($permission::ADMIN->value)
                  <x-icons.roles class="text-2xl flex text-blue-400 w-8 h-8 cursor-pointer" href="{{ route('user.roles', $u->id) }}"
                    id="roles-{{ $u->id }}" wire:navigate />
                  @endcan

                  @can($permission::USER_UPDATE->value)
                  <x-icons.edit class="text-2xl flex text-yellow-400 w-8 h-8 cursor-pointer" wire:click="$dispatch('user::editing', { id: {{ $u->id }}})"
                    id="edit-{{ $u->id }}"/>
                  @endcan

                  @can($permission::USER_DELETE->value)
                  <x-icons.delete id="deactive-{{ $u->id }}" wire:click="$dispatch('user::deactivating', { id: {{ $u->id }}})"
                    class="cursor-pointer text-2xl flex text-red-600 w-8 h-8" />
                  @endcan
                @else
                  @can($permission::USER_DELETE->value)
                    <x-icons.recycle class="text-2xl flex text-green-400 w-8 h-8 cursor-pointer" id="active-{{ $u->id }}" wire:click="$dispatch('user::activating', { id: {{ $u->id }} })"/>
                  @endcan
                @endif
              </div>
            @endif
          </x-table.td>
        @endcanany
      </x-table.tr>
      @empty
        <x-table.tr-no-register :cols="count($theader)"/>
      @endforelse
    </x-slot:tbody>
  </x-table.table>
  <div class="pt-6 px-2">
    {{ $this->users->onEachSide(1)->links() }}
  </div>

  <livewire:user.deactivate />
  <livewire:user.activate />
  <livewire:user.edit />
</div>
