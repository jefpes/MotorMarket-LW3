<div>
  <x-slot:header> {{ __('Dashboard') }} </x-slot:header>

  <div class="flex flex-wrap gap-4">
    <div class="relative max-w-sm w-full bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
      <span
        class="bg-blue-200  font-medium text-blue-800 text-center p-0.5 leading-none rounded-full px-2 dark:bg-blue-900 dark:text-blue-200 absolute -translate-y-1/2 translate-x-1/2 right-1/2">
        {{ __('Users') . ': ' . $this->users }}
      </span>
      <ul class="max-w-md space-y-1 list-decimal list-inside text-gray-500 dark:text-gray-400 px-2 py-4">
        @foreach ($this->roles as $role )
        <li>
          {{ __('Role') . ': ' }}<span class="font-semibold text-gray-900 dark:text-white">{{ $role->name }}</span> {{ __('with') }}
          <span class="font-semibold text-gray-900 dark:text-white">{{ $role->users_count }}</span> {{ __('people') }}
        </li>
        @endforeach
        <li>
          {{ __('Role') . ': ' }}<span class="font-semibold text-gray-900 dark:text-white">{{ __('No Role') }}</span> {{ __('with') }}
          <span class="font-semibold text-gray-900 dark:text-white">{{ $this->usersNoFunction }}</span> {{ __('people') }}
        </li>
      </ul>
    </div>

    <div class="relative max-w-sm w-full bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
      <span
        class="bg-blue-200  font-medium text-blue-800 text-center p-0.5 leading-none rounded-full px-2 dark:bg-blue-900 dark:text-blue-200 absolute -translate-y-1/2 translate-x-1/2 right-1/2">
        {{ __('Stock') . ': ' . $this->stock->count() }}
      </span>
      <ul class="max-w-md space-y-1 list-decimal list-inside text-gray-500 dark:text-gray-400 px-2 py-4">
        @foreach ($this->vType as $data)
        <li>
          {{ __('Type') . ': ' }}<span class="font-semibold text-gray-900 dark:text-white">{{ $data->name }}</span> {{ __('with') }}
          <span class="font-semibold text-gray-900 dark:text-white">{{ $data->total_vehicles }}</span> {{ __('vehicle') }}
          <div>
            {{ __('Total Purchase Price') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">R$ {{ $data->total_purchase_price }}</span> <br/>
            {{ __('Total Sale Price') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">R$ {{ $data->total_sale_price }}</span> <br/>
            {{ __('Total Expense') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">R$ {{ $data->total_expense }}</span> <br />
            {{ __('Total Stock Value') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">R$ {{ $data->total_stock_value }}</span>
          </div>
        </li>
        @endforeach
      </ul>
    </div>

    <div class="relative max-w-sm w-full bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
      <span
        class="bg-blue-200  font-medium text-blue-800 text-center p-0.5 leading-none rounded-full px-2 dark:bg-blue-900 dark:text-blue-200 absolute -translate-y-1/2 translate-x-1/2 right-1/2">
        {{ __('Sales') . ': ' . $this->sales->count() }}
      </span>
      <ul class="max-w-md space-y-1 list-decimal list-inside text-gray-500 dark:text-gray-400 px-2 py-4">
        @foreach ($this->salesType as $sale)
        <li>
          {{ __('Type') . ': ' }}<span class="font-semibold text-gray-900 dark:text-white">{{ $sale->name }}</span> {{ __('with') }}
          <span class="font-semibold text-gray-900 dark:text-white">{{ $sale->number_of_sales }}</span> {{ __('vehicle') }}
          <div>
            {{ __('Total Purchase Price') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">R$ {{ $sale->total_purchase_price }}</span> <br/>
            {{ __('Total Sale Price') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">R$ {{ $sale->total_sales }}</span> <br />
            {{ __('Total Expense') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">R$ {{ $sale->total_expenses }}</span> <br />
            {{ __('Total Profit') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">R$ {{ $sale->profit }}</span>
          </div>
        </li>
        @endforeach
      </ul>
    </div>

    <div class="relative max-w-sm w-full bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
      <span
        class="bg-blue-200  font-medium text-blue-800 text-center p-0.5 leading-none rounded-full px-2 dark:bg-blue-900 dark:text-blue-200 absolute -translate-y-1/2 translate-x-1/2 right-1/2">
        {{ __('Sales') . ': ' . $this->salesFilter->count() }}
      </span>

      <div class="w-full p-2">
        <div class="pb-2">
          <x-input-label for="date_ini" value="{{ __('Sale Date') }}" />
          <x-text-input type="date" id="date_ini" wire:model.live.debounce.500ms='date_ini' />
        <span class="w-2/12">  {{ __('to') }} </span>
          <x-text-input type="date" id="date_end" wire:model.live.debounce.500ms='date_end' class="w-5/12" />
        </div>
        <div class="pb-2">
          <x-input-label for="sts_select" value="{{ __('Status') }}" />
          <x-select wire:model.live="status" class="w-full" id="sts_select">
            <option value=""> {{ __('All')}} </option>
            @foreach ($sts as $data)
            <option value="{{ $data->value }}"> {{ $data->value }} </option>
            @endforeach
          </x-select>
        </div>
        <div class="pb-2">
          <x-input-label for="payment_method" value="{{ __('Payment Method') }}" />
          <x-select wire:model.live="payment_method" class="w-full" id="payment_method">
            <option value=""> {{ __('All')}} </option>
            @foreach ($payment_methods as $data)
            <option value="{{ $data->value }}"> {{ $data->value }} </option>
            @endforeach
          </x-select>
        </div>
      </div>
      <ul class="max-w-md space-y-1 list-decimal list-inside text-gray-500 dark:text-gray-400 px-2 py-4">
        @foreach ($this->salesTypeFilter as $sale)
        <li>
          {{ __('Type') . ': ' }}<span class="font-semibold text-gray-900 dark:text-white">{{ $sale->name }}</span> :
          <span class="font-semibold text-gray-900 dark:text-white">{{ $sale->number_of_sales }}</span>
          <div>
            {{ __('Total Purchase Price') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">{{ ' R$ '.$sale->total_purchase_price }}</span> <br/>
            {{ __('Total Sale Price') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">{{ ' R$ '.$sale->total_sales }}</span> <br />
            {{ __('Total Expense') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">R$ {{ $sale->total_expenses }}</span> <br />
            {{ __('Total Profit') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">{{ ' R$ '.$sale->profit }}</span>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
