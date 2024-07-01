<div>
    <x-slot name="header">{{ __($header) }}</x-slot>

      <div class="flex flex-col md:flex-row gap-2 pb-3 flex-0 sm:flex justify-between">
        <div class="flex flex-col md:flex-row gap-2 flex-0 sm:flex">
        <div class="flex-none">
          <x-input-label for="due_date_i" value="{{ __('Due Date') }}" />
          <x-text-input type="date" id="due_date_i" wire:model.live.debounce.500ms='due_date_i' />
          {{ __('to') }} <x-text-input type="date" id="due_date_f" wire:model.live.debounce.500ms='due_date_f' />
        </div>

        <div class="flex-none">
          <x-input-label for="pay_date_i" value="{{ __('Payment Date') }}" />
          <x-text-input type="date" id="pay_date_i" wire:model.live.debounce.500ms='pay_date_i' />
          {{ __('to') }} <x-text-input type="date" id="pay_date_f" wire:model.live.debounce.500ms='pay_date_f' />
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
          <div>
            <x-input-label for="payment_method" value="{{ __('Payment Method') }}" />
            <x-select wire:model.live="payment_method" class="w-full" id="payment_method">
              <option value=""> {{ __('All')}} </option>
              @foreach ($payment_methods as $data)
              <option value="{{ $data->value }}"> {{ $data->value }} </option>
              @endforeach
            </x-select>
          </div>
          <div>
            <x-input-label for="sts_select" value="{{ __('Status') }}" />
            <x-select wire:model.live="status" class="w-full" id="sts_select">
              <option value=""> {{ __('All')}} </option>
              @foreach ($sts as $data)
                <option value="{{ $data->value }}"> {{ $data->value }} </option>
              @endforeach
            </x-select>
          </div>
        </div>
      </div>

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
        @foreach ($this->installments as $i)
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
        @endforeach
      </x-slot:tbody>
    </x-table.table>
    <div class="pt-6 px-2">
      {{ $this->installments->onEachSide(1)->links() }}
    </div>
</div>
