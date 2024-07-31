<div>
  @if ($sale)
  <x-modal wire:model="modal" name="cancel_sale_modal_{{ $sale->id }}">
    <x-slot:title>
      {{ __('Cancelling Sale') }}
    </x-slot:title>
    <ul class="space-y-1">
      <li>{{ __('Date Sale') }}: <x-span-date :date="$sale->date_sale"/></li>
      <li>{{ __('Total Sale Price') }}: <x-span-money :money="$sale->total" /></li>
      @if ($sale->discount > 0)
        <li>{{ __('Discount') }}: <x-span-money :money="$sale->discount" /></li>
      @endif
      @if ($sale->surcharge > 0)
          <li>{{ __('Surcharge') }}: <x-span-money :money="$sale->surcharge" /></li>
      @endif
      @if ($sale->down_payment > 0)
          <li>{{ __('Down Payment') }}: <x-span-money :money="$sale->down_payment" /></li>
      @endif
      @if ($sale->number_installments > 1)
          <li>{{ __('Installments') }}: {{ $sale->paymentInstallments->count() }}</li>
          <li>{{ __('Installment Value') }}: <x-span-money :money="$sale->paymentInstallments[0]->value" /></li>
          <li>{{ __('Installments Paid') }}: {{ $sale->paymentInstallments->where('status', 'PAGO')->count() }}</li>
          <li>{{ __('Value of Installments Paid') }}: <x-span-money :money="$sale->paymentInstallments->where('status', 'PAGO')->sum('value')" /></li>
      @endif
        <li>{{ __('Total Received') }}: <x-span-money :money="($sale->paymentInstallments->where('status', 'PAGO')->sum('value') ?? 0)+($sale->down_payment ?? 0)" /></li>
    </ul>
    <div class="align-middle justify-center text-red-400">
      <p>
        {{__('This operation cannot be undone.')}}
      </p>
    </div>


    <div class="w-full pt-4">
      <x-form.money-input name="reimbursement" label="Reimbursement" placeholder="Reimbursement"
        :messages="$errors->get('reimbursement')" wire:model="reimbursement"
        class="w-full" />
    </div>

    <x-slot:footer>
      <x-secondary-button wire:click="$set('modal', false)">
        {{ __('Close') }}
      </x-secondary-button>

      <x-primary-button wire:click="cancel" class="ms-3">
        {{ __('Cancel') }}
      </x-primary-button>
    </x-slot:footer>
  </x-modal>

  <x-toast :$msg :$icon />
  @endif
</div>
