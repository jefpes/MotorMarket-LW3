<div>
    <x-slot name="header">{{ __($header) }}</x-slot>
    <div class="flex justify-end mb-4 mr-4">
      <x-icons.filter class="cursor-pointer w-6 h-6 text-gray-800 hover:text-blue-500 dark:text-gray-200 dark:hover:text-blue-500"
        wire:click="$set('modal', true)" />
    </div>

    <x-modal wire:model="modal" name="filter_modal">
      <x-slot:title> {{ __('Filters') }} </x-slot:title>
      <div class="space-y-2">
        <div class="flex gap-x-2">
          <div class="flex-1">
            <x-form.input class="w-full" label="Due date after" type="date" name="due_date_i" wire:model.live.debounce.500ms='due_date_i' />
          </div>

          <div class="flex-1">
            <x-form.input class="w-full" label="Due date before" type="date" name="due_date_e" wire:model.live.debounce.500ms='due_date_e' />
          </div>
        </div>

        <div class="flex gap-x-1">
          <div class="flex-1">
            <x-form.input class="w-full" label="Pay date after" type="date" name="pay_date_i" wire:model.live.debounce.500ms='pay_date_i' />
          </div>

          <div class="flex-1">
            <x-form.input class="w-full" label="Pay date before" type="date" name="pay_date_e" wire:model.live.debounce.500ms='pay_date_e' />
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

          <div class="flex-1">
            <x-select label="Payment Method" wire:model.live="payment_method" class="w-full" id="payment_method">
              <option value=""> {{ __('All')}} </option>
              @foreach ($payment_methods as $data)
              <option value="{{ $data->value }}"> {{ $data->value }} </option>
              @endforeach
            </x-select>
          </div>
        </div>

        <div class="flex gap-x-2">
          <div class="flex-1">
            <x-select label="Status" wire:model.live="status" class="w-full" id="sts_select">
              <option value=""> {{ __('All')}} </option>
              @foreach ($sts as $data)
              <option value="{{ $data->value }}"> {{ $data->value }} </option>
              @endforeach
            </x-select>
          </div>

          <div class="flex items-end">
            <x-danger-button class="ms-3" type="button" wire:click="overdue"> {{ __('Overdue Payments') }} </x-danger-button>
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


    <x-table.table>
      <x-slot:thead>
        @foreach ($theader as $h)
        @if ($h == 'Actions')
        @canany(['payment_receive', 'payment_undo'])
        <x-table.th> {{ __($h) }} </x-table.th>
        @endcanany
        @else
        <x-table.th> {{ __($h) }} </x-table.th>
        @endif
        @endforeach
      </x-slot:thead>
      <x-slot:tbody>
        @forelse ($this->installments as $i)
        <x-table.tr>
          <x-table.td> {{ $loop->iteration }} </x-table.td>
          <x-table.td> {{ $i->sale->client->name }} </x-table.td>
          <x-table.td> <x-span-date :date="$i->due_date" /> </x-table.td>
          <x-table.td> <x-span-money class="py-4" :money="$i->value" /> </x-table.td>
          <x-table.td> <x-span-date :date="$i->payment_date" /> </x-table.td>
          <x-table.td> {{ $i->payment_method ?? '' }} </x-table.td>
          <x-table.td> <x-span-money class="py-4" :money="$i->payment_value" /> </x-table.td>
          <x-table.td> {{ $i->status }} </x-table.td>
          <x-table.td> {{ $i->user->name ?? '' }} </x-table.td>

          @canany(['payment_undo', 'payment_receive'])
          <x-table.td>
            <div class="flex flex-row gap-2">
              @if ($i->status != 'CANCELADO')
              <x-icons.eye class="text-2xl flex w-8 h-8 cursor-pointer text-yellow-400" id="show-{{ $i->id }}"
                :href="route('sale.installments', $i->sale_id)" wire:navigate />
              @endif
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
      {{ $this->installments->onEachSide(1)->links() }}
    </div>
</div>
