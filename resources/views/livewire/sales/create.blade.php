<div>
  <x-slot name="header"> {{ __($header) . ': ' . $vehicle->plate . ' - ' . $vehicle->model->name . ' - ' . $vehicle->type->name . ' - ' . __('Price') . ': ' . $originalPrice}} </x-slot>


  <div class="space-y-2 mb-4">
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-1">
        <x-select wire:model="sale_form.client_id" label="Client" class="w-full">
          <option value="">{{ __('Select a Client') }}</option>
          @foreach ($this->clients as $client)
          <option value="{{ $client->id }}">{{ $client->name }} - {{ $client->cpf }}</option>
          @endforeach
        </x-select>
      </div>
      <div class="flex-1">
        <x-select wire:model.live="sale_form.payment_method" label="Payment Method" class="w-full">
          <option value="">{{ __('Select a Payment Method') }}</option>
          @foreach ($payment_method as $paymentMethod)
          <option value="{{ $paymentMethod->value }}">{{ $paymentMethod->value }}</option>
          @endforeach
        </x-select>
      </div>
      <div class="flex-1">
        <x-form.input type="date" name="date_sale" label="Date Sale" placeholder="Date Sale"
          :messages="$errors->get('sale_form.date_sale')" wire:model="sale_form.date_sale" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2 items-center">
      <div class="flex-0">
        <x-select wire:model.live="type" class="w-full" label="Type">
          <option value="discount">{{ __('Discount') }}</option>
          <option value="surcharge">{{ __('Surcharge') }}</option>
        </x-select>
      </div>
      <div class="flex-1">
        @if ($type == 'discount')
          <x-form.input x-mask="9999999" name="discount" label="Discount" placeholder="Discount"
            :messages="$errors->get('sale_form.discount')" wire:model.live="sale_form.discount" class="w-full" />
        @else
          <x-form.input x-mask="9999999" name="surchange" label="Surchange" placeholder="Surchange"
            :messages="$errors->get('sale_form.surchange')" wire:model.live="sale_form.surchange" class="w-full" />
        @endif
      </div>
      <div class="flex-1">
        <x-form.input disabled x-mask="99999999999" name="plate" label="Total" placeholder="Total"
          :messages="$errors->get('sale_form.total')" wire:model="sale_form.total" class="w-full" />
      </div>
      <div class="flex-0">
        <x-toggle text="Deferred Payment" :ckd="$deferred_payment" wire:model.live='deferred_payment' />
      </div>
    </div>

    @if ($deferred_payment)
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-1">
        <x-form.input x-mask="9999999" name="down_payment" label="Down Payment" placeholder="Down Payment"
          :messages="$errors->get('down_payment')" wire:model.live.debounce.1000ms="down_payment" class="w-full" />
      </div>
      <div class="flex-0">
        <x-form.input x-mask="999" name="number_installments" label="Number of Installments" placeholder="Number of Installments"
          :messages="$errors->get('number_installments')" wire:model.live.debounce.1000ms="number_installments" class="w-full" />
      </div>
      <div class="flex-1">
        <x-form.input disabled name="value_installments" label="Value of Installments" placeholder="Value of Installments"
        :messages="$errors->get('value_installments')" wire:model.live.debounce.1000ms="value_installments" class="w-full" />
      </div>
      <div class="flex-1">
      <x-form.input type="date" name="date_first_installment" label="Date First Installment"
        :messages="$errors->get('date_first_installment')" wire:model="date_first_installment" class="w-full" />
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
</div>

