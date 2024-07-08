<div>
  <x-slot name="header">{{ __($header) }}</x-slot>
  <div class="flex flex-row flex-wrap md:flex-nowrap w-full mb-4 gap-x-2 gap-y-2">
    <div class="w-full flex-1">
      <x-form.input name="search" type="text" placeholder="Search" :messages="$errors->get('search')"
        wire:model.live.debounce.800="search" class="w-full" />
    </div>

    @can('client_create')
    <div class="gap-2 flex flex-0">
      <x-primary-button :href="route('client.create')"  wire:navigate > {{ __('New') }} </x-primary-button>
    </div>
    @endcan

  </div>

  <x-table.table>
    <x-slot:thead>
      @foreach ($theader as $h)
        @if ($h == 'Actions')
          @canany(['client_update', 'client_delete'])
            <x-table.th> {{ __($h) }} </x-table.th>
          @endcanany
          @else
            <x-table.th> {{ __($h) }} </x-table.th>
        @endif
      @endforeach
    </x-slot:thead>
    <x-slot:tbody>
      @forelse ($this->clients->items() as $c)
        <x-table.tr>
          <x-table.td> {{ $c->name }} </x-table.td>
          <x-table.td> {{ $c->rg }} </x-table.td>
          <x-table.td> {{ $c->cpf }} </x-table.td>
          <x-table.td> {{ $c->phone_one }} </x-table.td>
          <x-table.td> <x-span-date :date="$c->birth_date" /> </x-table.td>


          @canany(['client_delete', 'client_update'])
          <x-table.td>
            <div class="flex flex-row gap-2 justify-center">

              <x-icons.eye class="text-2xl flex w-8 h-8 cursor-pointer" id="show-{{ $c->id }}" href="{{ route('client.show', $c->id) }}" wire:navigate />

              @can('client_update')
                <x-icons.edit class="text-2xl flex text-yellow-400 w-8 h-8 cursor-pointer" id="edit-{{ $c->id }}" href="{{ route('client.edit', $c->id) }}" wire:navigate />
              @endcan

              @can('client_delete')
                <x-icons.delete class="cursor-pointer text-2xl flex text-red-600 w-8 h-8" id="btn-delete-{{ $c->id }}" wire:click="$dispatch('client::deleting', { id: {{ $c->id }}})" />
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
  <div class="pt-6 px-2">
    {{ $this->clients->onEachSide(1)->links() }}
  </div>

  <livewire:client.delete />
</div>
