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
        @foreach ($this->vType as $type)
        <li>
          {{ __('Type') . ': ' }}<span class="font-semibold text-gray-900 dark:text-white">{{ $type->name }}</span> {{ __('with') }}
          <span class="font-semibold text-gray-900 dark:text-white">{{ $type->vehicles_count }}</span> {{ __('vehicle') }}
          <div>
            {{ __('Total Purchase Price') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">{{ ' R$ '.$type->vehicles->sum('purchase_price') }}</span> <br/>
            {{ __('Total Sale Price') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">{{ ' R$ '.$type->vehicles->sum('sale_price') }}</span>
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
            {{ __('Total Purchase Price') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">{{ ' R$ '.$sale->total_purchase_price }}</span> <br/>
            {{ __('Total Sale Price') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">{{ ' R$ '.$sale->total_sales }}</span> <br />
            {{ __('Profit') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">{{ ' R$ '.$sale->profit }}</span>
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
            {{ __('Total Purchase Price') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">{{ ' R$ '.$sale->total_purchase_price }}</span> <br/>
            {{ __('Total Sale Price') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">{{ ' R$ '.$sale->total_sales }}</span> <br />
            {{ __('Profit') . ': ' }} <span class="font-semibold text-gray-900 dark:text-white">{{ ' R$ '.$sale->profit }}</span>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
