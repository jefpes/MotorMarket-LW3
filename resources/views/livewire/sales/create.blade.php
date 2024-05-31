<div>
  <x-slot name="header"> {{ __($header) . ': ' . $vehicle->plate . ' - ' . $vehicle->model->name . ' - ' . $vehicle->type->name . ' - ' . __('Price') . ': ' . $originalPrice}} </x-slot>


  <div class="space-y-2 mb-4">
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-1">
        <x-select wire:model="form.client_id" label="Client" class="w-full">
          <option value="">{{ __('Select a Client') }}</option>
          @foreach ($this->clients as $client)
          <option value="{{ $client->id }}">{{ $client->name }} - {{ $client->cpf }}</option>
          @endforeach
        </x-select>
      </div>
      <div class="flex-1">
        <x-select wire:model.live="form.payment_method" label="Payment Method" class="w-full">
          <option value="">{{ __('Select a Payment Method') }}</option>
          @foreach ($payment_method as $paymentMethod)
          <option value="{{ $paymentMethod->value }}">{{ $paymentMethod->value }}</option>
          @endforeach
        </x-select>
      </div>
      <div class="flex-1">
        <x-form.input type="date" name="date_sale" label="Date Sale" placeholder="Date Sale"
          :messages="$errors->get('form.date_sale')" wire:model="form.date_sale" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-0">
        <x-select wire:model.live="type" class="w-full" label="Type">
          <option value="discount">{{ __('Discount') }}</option>
          <option value="surcharge">{{ __('Surcharge') }}</option>
        </x-select>
      </div>
      <div class="flex-1">
        @if ($type == 'discount')
          <x-form.input x-mask="9999999" name="discount" label="Discount" placeholder="Discount"
            :messages="$errors->get('form.discount')" wire:model.live="discount" class="w-full" />
        @else
          <x-form.input x-mask="9999999" name="surchange" label="Surchange" placeholder="Surchange"
            :messages="$errors->get('form.surchange')" wire:model.live="surchange" class="w-full" />
        @endif
      </div>
      <div class="flex-1">
        <x-form.input disabled x-mask="99999999999" name="plate" label="Total" placeholder="Total"
          :messages="$errors->get('form.total')" wire:model="form.total" class="w-full" />
      </div>
    </div>

    @if ($form->payment_method == 'CREDIÁRIO PRÓPRIO' || $form->payment_method == 'BOLETO BANCÁRIO')
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-0">
        <x-form.input x-mask="999" name="number_installments" label="Number of Installments" placeholder="Number of Installments"
          :messages="$errors->get('number_installments')" wire:model.live.debounce.200ms="number_installments" class="w-full" />
      </div>
      <div class="flex-1">
        <x-form.input disabled name="value_installments" label="Value of Installments" placeholder="Value of Installments"
          :messages="$errors->get('value_installments')" wire:model.live="value_installments" class="w-full" />
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

