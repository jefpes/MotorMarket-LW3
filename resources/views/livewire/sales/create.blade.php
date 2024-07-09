<div>
  <x-slot name="header"> {{ __($header) . ': ' . $vehicle->plate . ' - ' . $vehicle->model->name . ' - ' . $vehicle->model->type->name . ' - ' . __('Price') . ': '}} <x-span-money :money="$vehicle->sale_price" /> </x-slot>


  <div class="space-y-2 mb-4">
    <div class="flex flex-col md:flex-row justify-between md:space-x-2 space-y-2 md:space-y-0">
      <div class="flex-1">
        <x-select wire:model="sale_form.client_id" label="Client" class="w-full">
          <option value="">{{ __('Select a Client') }}</option>
          @foreach ($this->clients as $client)
          <option value="{{ $client->id }}">{{ $client->name }} - {{ $client->cpf }}</option>
          @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('sale_form.client_id')" />
      </div>
      <div class="flex-1">
        <x-select wire:model.live="sale_form.payment_method" label="Payment Method" class="w-full">
          <option value="">{{ __('Select a Payment Method') }}</option>
          @foreach ($payment_method as $paymentMethod)
          <option value="{{ $paymentMethod->value }}">{{ $paymentMethod->value }}</option>
          @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('sale_form.payment_method')" />
      </div>
      <div class="flex-1">
        <x-form.input type="date" name="date_sale" label="Sale Date"
          :messages="$errors->get('sale_form.date_sale')" wire:model="sale_form.date_sale" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2 space-y-2 md:space-y-0">
      <div class="flex-0">
        <x-select wire:model.live="type" class="w-full" label="Type">
          <option value="discount">{{ __('Discount') }}</option>
          <option value="surcharge">{{ __('Surcharge') }}</option>
        </x-select>
      </div>
      <div class="flex-1">
        @if ($type == 'discount')
          <x-form.money-input name="discount" label="Discount" placeholder="Discount"
            :messages="$errors->get('sale_form.discount')" wire:model.live.debounce.1000ms="sale_form.discount" class="w-full" />
        @else
          <x-form.money-input name="surcharge" label="Surcharge" placeholder="Surcharge"
            :messages="$errors->get('sale_form.surcharge')" wire:model.live.debounce.1000ms="sale_form.surcharge" class="w-full" />
        @endif
      </div>
      <div class="flex-1">
        <x-form.money-input name="plate" label="Total" placeholder="Total"
          :messages="$errors->get('sale_form.total')" wire:model="sale_form.total" class="w-full" />
      </div>
      <div class="flex-0 md:pt-6">
        <x-toggle text="In Installments" :ckd="$inInstallments" wire:model.live='inInstallments' />
      </div>
    </div>

    @if ($inInstallments)
    <div class="flex flex-col md:flex-row justify-between md:space-x-2 space-y-2 md:space-y-0">
      <div class="flex-1">
        <x-form.money-input name="down_payment" label="Down Payment" placeholder="Down Payment"
          :messages="$errors->get('sale_form.down_payment')" wire:model.live.debounce.1000ms="sale_form.down_payment" class="w-full" />
      </div>
      <div class="flex-0">
        <x-form.input type="number" min="1" max="50" name="number_installments" label="Number of Installments" placeholder="Number of Installments"
          :messages="$errors->get('sale_form.number_installments')" wire:model.live.debounce.1000ms="sale_form.number_installments" class="w-full" />
      </div>
      <div class="flex-1">
        <x-form.money-input disabled name="installment_value" label="Installment Value" placeholder="Installment Value"
        :messages="$errors->get('installment_value')" wire:model.live.debounce.1000ms="installment_value" class="w-full" />
      </div>
      <div class="flex-1">
      <x-form.input type="date" name="first_installment_date" label="First Installment Date"
        :messages="$errors->get('first_installment_date')" wire:model="first_installment_date" class="w-full" />
      </div>
    </div>
    @endif

    <div class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600 justify-end">
      <x-secondary-button :href="route('vehicle')" wire:navigate>
        {{ __('Back') }}
      </x-secondary-button>

      <x-primary-button wire:click="save" class="ms-3">
        {{ __('Sale') }}
      </x-primary-button>
    </div>
  </div>
  <x-toast on="show-toast" :$icon>
    {{ __( $msg ) }}
  </x-toast>
</div>

