<div>
  <x-modal wire:model="modal" name="receive_modal">
    <x-slot:title> {{ __($title) }}: <x-span-money :money="$form->value" /> </x-slot:title>

    <div class="space-y-2">
      <div class="flex flex-col md:flex-row justify-between md:space-x-2 gap-y-2">
        <div class="flex-0">
          <x-select label="Payment Method" wire:model="form.payment_method" class="w-full">
            @foreach ($payment_methods as $pm)
            <option value="{{ $pm->value }}"> {{ $pm->value }} </option>
            @endforeach
          </x-select>
        </div>
        <div class="flex-1">
          <x-form.date-input name="date" label="Payment Date" :messages="$errors->get('form.payment_date')"
            wire:model="form.payment_date" class="w-full" />
        </div>
      </div>

      <div class="flex flex-col md:flex-row justify-between md:space-x-2 gap-y-2">
        <div class="flex-0">
          <x-select wire:model.live="type" class="w-full" label="Type">
            <option value="discount">{{ __('Discount') }}</option>
            <option value="surcharge">{{ __('Surcharge') }}</option>
          </x-select>
        </div>

        <div class="flex-1">
          @if ($type == 'discount')
            <x-form.money-input name="discount" label="Discount" placeholder="Discount" :messages="$errors->get('form.discount')"
              wire:model.live.debounce.1000ms="form.discount" class="w-full" />
              @else
            <x-form.money-input name="surcharge" label="Surcharge" placeholder="Surcharge"
            :messages="$errors->get('form.surcharge')" wire:model.live.debounce.1000ms="form.surcharge" class="w-full" />
          @endif
        </div>

        <div class="flex-1">
          <x-form.money-input disabled name="value" label="Payment Value" type="text" x-mask="9999999"
          :messages="$errors->get('form.payment_value')" wire:model.live.debounce.1000ms="form.payment_value"
          class="w-full" />
        </div>
      </div>
    </div>

    <x-slot:footer>
      <x-secondary-button type="button" wire:click="cancel">
        {{ __('Cancel') }}
      </x-secondary-button>

      <x-primary-button wire:click="save" class="ms-3">
        {{ __('Receive') }}
      </x-primary-button>
    </x-slot:footer>
  </x-modal>

  <x-toast :$msg :$icon />
</div>
