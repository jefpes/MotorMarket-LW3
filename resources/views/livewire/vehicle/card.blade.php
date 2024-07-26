<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
  <a href="{{ route('vehicle.show', $vehicle->id) }}" wire:navigate>
    @if ($vehicle->photos()->first() && Storage::exists("/vehicle_photos/".$vehicle->photos()->first()->photo_name))
      <img class="rounded-t-lg max-h-72" src="{{ $vehicle->photos()->first()->path }}" alt="{{ $vehicle->surname }}"/>
      @else
      <x-icons.no-image class="w-full h-72" />
    @endif
  </a>
  <div class="p-2">
    <div class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Purchase Date') }}: </span> <x-span-date :date="$vehicle->purchase_date" /> </p>
      </div>
      @if($vehicle->fipe_price)
        <div class="flex">
          <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Fipe Price') }}: </span> <x-span-money class="py-4" :money="$vehicle->fipe_price" /> </p>
        </div>
      @endif
      @can($permission::VEHICLE_CREATE->value)
        <div class="flex">
          <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Purchase Price') }}: </span> <x-span-money class="py-4" :money="$vehicle->purchase_price" /> </p>
        </div>
      @endcan
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Expense') }}: </span> <x-span-money class="py-4" :money="$vehicle->expenses->sum('value')" /> </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Sale Price') }}: </span> <x-span-money class="py-4" :money="$vehicle->sale_price" /> </p>
      </div>
      @if($vehicle->promotional_price)
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Promotional Price') }}: </span>
          <x-span-money class="py-4" :money="$vehicle->promotional_price" />
        </p>
      </div>
      @endif
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Type') }}: </span> {{ $vehicle->model->type->name ?? '' }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Brand') }}: </span> {{ $vehicle->model->brand->name ?? '' }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Model') }}: </span> {{ $vehicle->model->name ?? '' }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Year') }}: </span> {{ $vehicle->year_one .'/'. $vehicle->year_two }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('KM') }}: </span> {{ $vehicle->km ?? 0 }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Color') }}: </span> {{ $vehicle->color }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Plate') }}: </span> {{ $vehicle->plate }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Description') }}: </span> {{ $vehicle->description }} </p>
      </div>
      @if ($vehicle->annotation)
        <div class="flex">
          <p class="text-lg font-semibold"> <span class="text-gray-700 md:text-lg dark:text-gray-300 uppercase">{{ __('Annotation') }}: </span> {{ $vehicle->annotation }} </p>
        </div>
      @endif
    </div>
  </div>
  @canany([$permission::VEHICLE_UPDATE->value, $permission::VEHICLE_DELETE->value])
    <div class="flex flex-wrap gap-y-2 items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600 justify-end gap-x-2">
      @can($permission::VEHICLE_CREATE->value && $vehicle->supplier_id)
        <x-secondary-button wire:click="receiptPurchase({{ $vehicle->id }})"> {{ __('Receipt') }} </x-secondary-button>
      @endcan
      @can($permission::VEHICLE_EXPENSE_CREATE->value)
        <livewire:vehicle-expense.create v_id="{{ $vehicle->id }}" wire:key="expense_{{ $vehicle->id }}" />
      @endcan

      @can($permission::VEHICLE_UPDATE->value)
        <x-secondary-button :href="route('vehicle.edit', $vehicle->id)" wire:navigate> {{ __('Edit') }} </x-secondary-button>
      @endcan

      @can($permission::VEHICLE_DELETE->value)
        <livewire:vehicle.delete :id="$vehicle->id" wire:key="delete_{{ $vehicle->id }}" />
      @endcan

      @if(!$vehicle->sold_date)
        @can('sale_create')
          <x-primary-button :href="route('sale.create', $vehicle->id)" wire:navigate>{{ __('Sell') }}</x-primary-button>
        @endcan
      @endif

    </div>
  @endcanany

  <x-modal wire:model="modal" name="modal">
    <x-slot:title> {{ __('Receipt') }} </x-slot:title>
    <div class="w-full flex gap-2">
      <div class="flex-1">
        <x-form.input class="w-full" name="city_receipt" label="City" type="text" placeholder="City"
          :messages="$errors->get('city')" wire:model.live="city" />
      </div>

      {{-- <div class="flex-0">
        <x-form.input type="date" class="w-full" name="date" label="Data" :messages="$errors->get('date')"
          wire:model.live="date" />
      </div> --}}
    </div>

    <x-slot:footer>
      <x-secondary-button wire:click="$set('modal', false)">
        {{ __('Cancel') }}
      </x-secondary-button>

      @if ($modal)
      <a href="{{ route('receipt.purchase', [$vehicle_id, 'city' => ($city ?? 'Pentecoste/CE') ]) }}" id="receipt-{{ $vehicle->id }}"
        target="blank">
        <x-primary-button class="ms-3"> {{ __('Receipt') }} </x-primary-button>
      </a>
      @endif
    </x-slot:footer>
  </x-modal>
</div>
