<div>
  <x-slot name="header"> {{ __($header) }} </x-slot>

  <div class="flex justify-between gap-2 pb-3">
    <div class="flex-1">
      <div class="flex">
        <div class="flex items-center me-4">
          <x-toggle text="{{ $plate_filter ? 'Plate' : 'Client' }}" wire:click="plateClient" ckd="{{ $plate_filter }}" />
        </div>

        <div class="flex-1">
          @if ($plate_filter)
            <x-form.plate-input class="w-full" type="search" name="search" wire:model.live.debounce.1000ms="plate"
              placeholder="{{ __('Search plate') }}" />
            @else
            <x-text-input class="w-full" type="search" name="search" wire:model.live.debounce.1000ms="client"
              placeholder="{{ __('Search client') }}" />
          @endif
        </div>
      </div>
    </div>
    <div class="flex items-center">
      <x-icons.filter class="cursor-pointer w-8 h-8 text-gray-800 hover:text-blue-500 dark:text-gray-200 dark:hover:text-blue-500"
        wire:click="$set('filter_modal', true)" />
    </div>
  </div>

  <div>
    <x-table.table>
      <x-slot name="thead">
        @foreach ($this->table as $h)
          @if ($h->field == 'actions')
            @canany([$permission::SALE_CANCEL->value])
              <x-table.th> {{ __($h->head) }} </x-table.th>
            @endcanany
          @else
            <x-table.th class="cursor-pointer" wire:click="doSort('{{ $h->field }}')">
              <x-table.sortable :columnLabel="$h->head" :columnName='$h->field' :sortColumn="$sortColumn" :sortDirection="$sortDirection" />
            </x-table.th>
          @endif
        @endforeach
      </x-slot>
      <x-slot name="tbody">
        @forelse ($this->sales->items() as $s)
        <x-table.tr>
          <x-table.td> {{ $s->vehicle_plate }} </x-table.td>
          <x-table.td> {{ $s->client->name }} </x-table.td>
          <x-table.td> <x-span-date :date="$s->date_sale" /> </x-table.td>
          <x-table.td> <x-span-money class="py-4" :money="$s->total" /> </x-table.td>
          <x-table.td> {{ $s->status }} </x-table.td>
          <x-table.td> {{ $s->number_installments }} </x-table.td>
          <x-table.td> {{ $s->user_name }} </x-table.td>

          @canany([$permission::SALE_CANCEL->value, $permission::INSTALLMENT_READ->value])
            <x-table.td>
              <div class="flex flex-row gap-2 justify-center">
                <x-icons.eye class="text-2xl flex text-blue-400 w-8 h-8 cursor-pointer" href="{{ route('sale.show', $s->id) }}"
                  id="show-{{ $s->id }}" wire:navigate />
                @if (!$s->date_cancel)
                  @if ($s->number_installments > 1)
                    <x-icons.contract class="text-2xl flex text-green-400 w-8 h-8 cursor-pointer" wire:click="issueContract({{ $s->id }})" />

                    <x-icons.money-receive class="text-2xl flex text-blue-400 w-8 h-8 cursor-pointer"
                      href="{{ route('sale.installments', $s->id) }}" id="installments-{{ $s->id }}" wire:navigate />
                  @endif

                  @can($permission::SALE_CANCEL->value)
                    <x-icons.cancel id="btn-cancel-{{ $s->id }}"
                      wire:click="$dispatch('sale::canceling', { id: {{ $s->id }} })"
                      class="cursor-pointer text-2xl flex text-red-600 w-8 h-8" />
                  @endcan
                @else
                  <x-icons.fail class="text-2xl flex text-red-600 w-8 h-8" />
                @endif
              </div>
            </x-table.td>
          @endcanany
        </x-table.tr>
        @empty
          <x-table.tr-no-register :cols="count($this->table)" />
        @endforelse
      </x-slot>
    </x-table.table>
    <div class="pt-6 px-2">
      {{ $this->sales->onEachSide(1)->links() }}
    </div>
  </div>

  <livewire:sales.cancel />

  <x-modal wire:model="modal" name="amodal">
    <x-slot:title> {{ __('Issue Contract') }} </x-slot:title>
    <div class="w-full flex gap-2">
      <div class="flex-1">
        <x-form.input class="w-full" name="city" label="City" type="text" placeholder="City" :messages="$errors->get('city')"
          wire:model.live="city"/>
      </div>

      {{-- <div class="flex-0">
        <x-form.input type="date" class="w-full" name="date" label="Data" :messages="$errors->get('date')" wire:model.live="date" />
      </div> --}}
    </div>

    <x-slot:footer>
      <x-secondary-button wire:click="$set('modal', false)">
        {{ __('Cancel') }}
      </x-secondary-button>

      @if ($modal)
      <a href="{{ route('contract', [$sale_id, 'city' => ($city ?? 'Pentecoste/CE') ]) }}" id="contract-{{ $s->id }}" target="blank">
        <x-primary-button class="ms-3"> {{ __('Issue') }} </x-primary-button>
      </a>
      @endif
    </x-slot:footer>
  </x-modal>

  <x-modal wire:model="filter_modal" name="filter_modal">
    <x-slot:title> {{ __('Filters') }} </x-slot:title>
    <div class="space-y-4">
      <div class="flex gap-2">
        <div class="flex-1">
          <x-select class="w-full" label="Registers per page" wire:model.live="perPage">
            <option :value="10">10</option>
            <option :value="15">15</option>
            <option :value="25">25</option>
            <option :value="50">50</option>
          </x-select>
        </div>
        <div class="flex-1">
          <x-select class="w-full" wire:model.live="status" label="Status" class="w-full">
            <option value="">{{ __('All') }}</option>
            @foreach ($sts as $s)
            <option value="{{ $s->value }}">{{ $s->value }}</option>
            @endforeach
          </x-select>
        </div>
      </div>


      <x-form.date-input class="w-full" label="Sold after of" name="date_ini" wire:model.live='date_ini' />

      <x-form.input class="w-full" label="Sold after of" type="date" name="date_end" wire:model.live='date_end' />
    </div>

    <x-slot:footer>
      <x-secondary-button type="button" wire:click="$set('filter_modal', false)">
        {{ __('Close') }}
      </x-secondary-button>

      <x-primary-button class="ms-3" type="button" wire:click="resetFilters">
        {{ __('Reset Filter') }}
      </x-primary-button>
    </x-slot:footer>
  </x-modal>
</div>
