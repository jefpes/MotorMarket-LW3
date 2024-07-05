<div>
  <x-slot name="header"> {{ __('Users') }} </x-slot>
  <div class="pb-4 flex flex-col md:flex-row justify-between gap-y-4 md:gap-y-0">
    <div class="w-full md:7/12 lg:w-7/12">
      <x-text-input class="w-full" type="search" name="search" wire:model.live.debounce.1000ms="search"
        placeholder="Pesquisar...">
      </x-text-input>
    </div>
    <div class="w-full md:5/12 lg:w-5/12 flex justify-end gap-x-2">
      @can('user_create')
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
      @foreach ($theader as $h)
        @if ($h == 'Actions')
          @canany([$this->permissions->update, $this->permissions->delete])
            <x-table.th> {{ __($h) }} </x-table.th>
          @endcanany
        @else
          <x-table.th> {{ __($h) }} </x-table.th>
        @endif
      @endforeach
    </x-slot:thead>
    <x-slot:tbody>
      @forelse ($this->users->items() as $u)
      <x-table.tr>
        <x-table.td> {{ $u->name }} </x-table.td>
        <x-table.td> {{ $u->user_name }} </x-table.td>
        <x-table.td> {{ $u->email }} </x-table.td>
        <x-table.td> <span
          class="{{ $u->active ? 'bg-green-100 text-green-800 me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300'
            : 'bg-red-100 text-red-800 me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300'}}"> {{ $u->active ? __('Active') : __('Inactive') }} </span> </x-table.td>
        @canany(['user_delete', 'user_update'])
          <x-table.td>
            @if(auth()->user()->hierarchy($u->id))
              <div class="flex flex-row gap-2 justify-center">
                @if ($u->active)
                  @can($this->permissions->admin)
                  <x-icons.roles class="text-2xl flex text-blue-400 w-8 h-8 cursor-pointer" href="{{ route('user.roles', $u->id) }}"
                    id="roles-{{ $u->id }}" wire:navigate />
                  @endcan

                  @can($this->permissions->update)
                  <x-icons.edit class="text-2xl flex text-yellow-400 w-8 h-8 cursor-pointer" wire:click="$dispatch('user::editing', { id: {{ $u->id }}})"
                    id="edit-{{ $u->id }}"/>
                  @endcan

                  @can($this->permissions->delete)
                  <x-icons.delete id="deactive-{{ $u->id }}" wire:click="$dispatch('user::deactivating', { id: {{ $u->id }}})"
                    class="cursor-pointer text-2xl flex text-red-600 w-8 h-8" />
                  @endcan
                @else
                  @can($this->permissions->delete)
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
