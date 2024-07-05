<div>
  <x-slot name="header">{{ __($header) }}</x-slot>
  <div class="flex flex-row flex-wrap md:flex-nowrap w-full mb-4 gap-x-2 gap-y-2">
    <div class="w-full flex-1">
      <x-form.input name="search" type="text" placeholder="Search" :messages="$errors->get('search')"
        wire:model.live.debounce.800="search" class="w-full" />
    </div>

    @can('employee_create')
    <div class="gap-2 flex flex-0">
      <x-primary-button :href="route('employee.create')"  wire:navigate > {{ __('New') }} </x-primary-button>
    </div>
    @endcan

  </div>

  <x-table.table>
    <x-slot:thead>
      @foreach ($theader as $h)
        @if ($h == 'Actions')
          @canany(['employee_update', 'employee_delete'])
            <x-table.th> {{ __($h) }} </x-table.th>
          @endcanany
          @else
            <x-table.th> {{ __($h) }} </x-table.th>
        @endif
      @endforeach
    </x-slot:thead>
    <x-slot:tbody>
      @forelse ($this->employees->items() as $data)
        <x-table.tr>
          <x-table.td> {{ $data->name }} </x-table.td>
          <x-table.td> {{ $data->rg }} </x-table.td>
          <x-table.td> {{ $data->cpf }} </x-table.td>
          <x-table.td> {{ $data->phone_one }} </x-table.td>
          <x-table.td> {{ $data->birth_date }} </x-table.td>

          @canany(['employee_delete', 'employee_update'])
          <x-table.td>
            <div class="flex flex-row gap-2 justify-center">

              <x-icons.eye class="text-2xl flex w-8 h-8 cursor-pointer" id="show-{{ $data->id }}"
                href="{{ route('employee.show', $data->id) }}" wire:navigate />

              @can('employee_update')
              <x-icons.edit class="text-2xl flex text-yellow-400 w-8 h-8 cursor-pointer" id="edit-{{ $data->id }}"
                href="{{ route('employee.edit', $data->id) }}" wire:navigate />
              @endcan

              @can('employee_delete')
                @if ($data->resignation_date)
                  <x-icons.recycle class="cursor-pointer text-2xl flex text-red-600 w-8 h-8" id="btn-dismiss-{{ $data->id }}"
                    wire:click="$dispatch('employee::deleting', { id: {{ $data->id }} })" />
                  @else
                  <x-icons.delete class="cursor-pointer text-2xl flex text-red-600 w-8 h-8" id="btn-delete-{{ $data->id }}"
                    wire:click="$dispatch('employee::deleting', { id: {{ $data->id }}})" />
                @endif
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
    {{ $this->employees->onEachSide(1)->links() }}
  </div>

  <livewire:employee.delete />
</div>
