<div>
  <x-slot name="header"> {{ __($header) . ': ' . $vehicle->plate . ' - ' . $vehicle->model->name . ' - ' . $vehicle->type->name }} </x-slot>


  <div class="space-y-2 mb-4">
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="basis-1/3">
        <x-select wire:model="form.client_id" label="Client" class="w-full">
          <option value="">{{ __('Select a Client') }}</option>
          @foreach ($this->clients as $client)
          <option value="{{ $client->id }}">{{ $client->name }}</option>
          @endforeach
        </x-select>
      </div>
      <div class="basis-1/3">
        <x-select wire:model="form.payment_method" label="Payment Method" class="w-full">
          <option value="">{{ __('Select a Payment Method') }}</option>
          @foreach ($payment_method as $paymentMethod)
          <option value="{{ $paymentMethod->value }}">{{ $paymentMethod->value }}</option>
          @endforeach
        </x-select>
      </div>
      <div class="basis-1/3">
        <x-select wire:model="form.status" label="Status" class="w-full">
          <option value="">{{ __('Select a Status') }}</option>
          @foreach ($status as $s)
          <option value="{{ $s->value }}">{{ $s->value }}</option>
          @endforeach
        </x-select>
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="md:basis-1/2">
        <x-form.input type="date" name="date_sale" label="Date Sale" placeholder="Date Sale" :messages="$errors->get('form.date_sale')"
          wire:model="form.date_sale" class="w-full" />
      </div>
      <div class="md:basis-1/2">
        <x-form.input type="date" name="date_payment" label="Date Payment" placeholder="Date Payment"
          :messages="$errors->get('form.date_payment')" wire:model="form.date_payment" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="basis-1/2">
        <x-form.input x-mask="9999999" name="discount" label="Discount" placeholder="Discount"
          :messages="$errors->get('form.discount')" wire:model="form.discount" class="w-full" />
      </div>
      <div class="basis-1/2">
        <x-form.input x-mask="9999999" name="surchange" label="Surchange" placeholder="Surchange"
          :messages="$errors->get('form.surchange')" wire:model="form.surchange" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="basis-1/2">
        <x-form.input disabled name="sale_price" label="Sale Price" placeholder="Sale Price" :messages="$errors->get('form.km')"
          wire:model="originalPrice" class="w-full" />
      </div>
      <div class="basis-1/2">
        <x-form.input disabled x-mask="99999999999" name="plate" label="Total" placeholder="Total"
          :messages="$errors->get('total')" wire:model="total" class="w-full" />
      </div>
    </div>
  </div>


</div>

