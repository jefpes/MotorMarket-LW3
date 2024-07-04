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
        <x-primary-button href="{{route('users.create')}}" wire:navigate> {{__('New')}} </x-primary-button>
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
          @canany(['user_update', 'user_delete'])
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
        <x-table.td> {{ $u->regist_number }} </x-table.td>
        <x-table.td> {{ $u->email }} </x-table.td>
        @canany(['user_delete', 'user_update'])
          <x-table.td>
            @if(auth()->user()->hierarchy($u->id))
              <div class="flex flex-row gap-2 justify-center">
                @can('admin') <x-icons.roles class="text-2xl flex text-blue-400 w-8 h-8 cursor-pointer" href="{{ route('user.roles', $u->id) }}" id="roles-{{ $u->id }}" wire:navigate/> @endcan

                @can('user_update') <x-icons.edit class="text-2xl flex text-yellow-400 w-8 h-8 cursor-pointer" href="{{ route('users.edit', $u->id) }}" id="edit-{{ $u->id }}" wire:navigate /> @endcan

                @can('user_delete') <x-icons.delete id="btn-delete-{{ $u->id }}" wire:click="$dispatch('user::deleting', { id: {{ $u->id }}})" class="cursor-pointer text-2xl flex text-red-600 w-8 h-8"/> @endcan
              </div>
            @endif
          </x-table.td>
        @endcanany
      </x-table.tr>
      @empty
        <x-table.tr>
          <x-table.td colspan="{{ count($theader) }}" class="text-center text-4xl"> {{ __('No records found') }} </x-table.td>
        </x-table.tr>
      @endforelse
    </x-slot:tbody>
  </x-table.table>
  <div class="pt-6 px-2">
    {{ $this->users->onEachSide(1)->links() }}
  </div>

  <livewire:user.delete />
</div>
