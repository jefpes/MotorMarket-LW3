<div>
  <x-slot name="header">{{ __($header) }}</x-slot>

  <x-table.table>
    <x-slot:thead>
      @foreach ($theader as $h)
      @if ($h == 'Actions')
      @canany([$permission::PAYMENT_RECEIVE->value, $permission::PAYMENT_UNDO->value])
      <x-table.th> {{ __($h) }} </x-table.th>
      @endcanany
      @else
      <x-table.th> {{ __($h) }} </x-table.th>
      @endif
      @endforeach
    </x-slot:thead>
    <x-slot:tbody>
      @foreach ($installment as $i)
      <x-table.tr>
        <x-table.td> {{ $loop->iteration }} </x-table.td>
        <x-table.td> <x-span-date :date="$i->due_date" /> </x-table.td>
        <x-table.td> <x-span-money :money="$i->value" /> </x-table.td>
        <x-table.td> <x-span-date :date="$i->payment_date" /> </x-table.td>
        <x-table.td> <x-span-money :money="$i->payment_value" /> </x-table.td>
        <x-table.td> {{ $i->status }} </x-table.td>
        <x-table.td> {{ $i->user->name ?? '' }} </x-table.td>

        @canany([$permission::PAYMENT_UNDO->value, $permission::PAYMENT_RECEIVE->value])
        <x-table.td>
          <div class="flex flex-row gap-2">
            @if ($i->payment_date && $i->status != 'CANCELADO')
              @can($permission::PAYMENT_UNDO->value)
                <x-icons.undo class="text-2xl flex w-8 h-8 cursor-pointer text-red-600" id="show-{{ $i->id }}" wire:click="$dispatch('installment::undo-receive', { id: {{ $i->id }} })" />
              @endcan
            @else
              @can($permission::PAYMENT_RECEIVE->value)
                <x-icons.money-receive class="text-2xl flex w-8 h-8 cursor-pointer text-blue-600" id="show-{{ $i->id }}" wire:click="$dispatch('installment::receive', { id: {{ $i->id }} })" />
              @endcan
            @endif
          </div>
        </x-table.td>
        @endcanany
      </x-table.tr>
      @endforeach
    </x-slot:tbody>
  </x-table.table>

  <livewire:payment-installments.receive-payment />
  <livewire:payment-installments.undo-receive-payment />
</div>
