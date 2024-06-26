<div>
  <x-slot name="header"> {{ __($header) }} </x-slot>

  <div class="pb-4 flex flex-col md:flex-row justify-between gap-x-2 gap-y-4 md:gap-y-0">
    <div class="flex">
      <div class="flex items-center me-4">
        <input wire:model.live='filter' id="inline-radio" type="radio" value="plate" name="inline-radio-group"
          class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
        <label for="inline-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Plate') }}</label>
      </div>
      <div class="flex items-center me-4">
        <input wire:model.live='filter' id="inline-2-radio" type="radio" value="client" name="inline-radio-group"
          class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
        <label for="inline-2-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Client') }}</label>
      </div>
    </div>

    <div class="flex-1">
      @if ($filter == 'plate')
      <x-text-input class="w-full" type="search" name="search"
        wire:model.live.debounce.1000ms="plate"
        placeholder="{{ __('Search plate') }}" />
      @endif
      @if ($filter == 'client')
      <x-text-input class="w-full" type="search" name="search"
        wire:model.live.debounce.1000ms="client"
        placeholder="{{ __('Search client') }}" />
      @endif
    </div>
    <div class="flex-0">
      <x-text-input type="date" id="date_i" wire:model.live='date_ini' /> {{ __('to') }}
      <x-text-input type="date" id="date_f" wire:model.live='date_end' />
    </div>
    <div class="flex flex-0 gap-x-2">
      <x-select wire:model.live="perPage" class="flex">
        <option :value="10">10</option>
        <option :value="15">15</option>
        <option :value="25">25</option>
        <option :value="50">50</option>
      </x-select>

      <x-select wire:model.live="status" class="flex">
        <option value="">{{ __('All') }}</option>
        @foreach ($sts as $s)
          <option value="{{ $s->value }}">{{ $s->value }}</option>
        @endforeach
      </x-select>
    </div>
  </div>

  <div>
    <x-table.table>
      <x-slot name="thead">
        @foreach ($theader as $h)
          @if ($h == 'Actions')
            @canany(['sale_cancel'])
              <x-table.th> {{ __($h) }} </x-table.th>
            @endcanany
          @else
            <x-table.th> {{ __($h) }} </x-table.th>
          @endif
        @endforeach
      </x-slot>
      <x-slot name="tbody">
        @foreach ($this->sales->items() as $s)
        <x-table.tr>
          <x-table.td> {{ $s->vehicle->plate }} </x-table.td>
          <x-table.td> {{ $s->client->name }} </x-table.td>
          <x-table.td> <x-span-date :date="$s->date_sale" /> </x-table.td>
          <x-table.td> <x-span-money class="py-4" :money="$s->total" /> </x-table.td>
          <x-table.td> {{ $s->status }} </x-table.td>
          <x-table.td> {{ $s->number_installments }} </x-table.td>
          <x-table.td> {{ $s->user->name }} </x-table.td>

          @canany(['sale_cancel', 'installment_read'])
            @if (!$s->date_cancel)
              <x-table.td>
                <div class="flex flex-row gap-2 justify-center">
                  @if ($s->number_installments > 1)
                    <x-icons.contract class="text-2xl flex text-blue-400 w-8 h-8 cursor-pointer"
                      href="{{ route('sale.installments', $s->id) }}"
                      id="installments-{{ $s->id }}" wire:navigate />
                  @endif

                  @can('sale_cancel')
                    <x-icons.cancel id="btn-cancel-{{ $s->id }}"
                      wire:click="$dispatch('sale::canceling', { id: {{ $s->id }} })"
                      class="cursor-pointer text-2xl flex text-red-600 w-8 h-8" />
                  @endcan
                </div>
              </x-table.td>
            @endif
          @endcanany
        </x-table.tr>
        @endforeach
      </x-slot>
    </x-table.table>
  </div>

  <livewire:sales.cancel />
</div>
