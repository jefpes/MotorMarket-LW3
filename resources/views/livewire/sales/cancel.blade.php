<div>
  @if ($sale)
  <x-modal wire:model="modal" name="cancel_sale_modal_{{ $sale->id }}">
    <x-slot:title>
      {{ __('Cancelling Sale') }}: <span class="text-yellow-300">{{ $sale->date_sale . ' - ' . $sale->total}}</span>
    </x-slot:title>
    <div class="align-middle justify-center text-red-400">
      <p>
        {{__('This operation cannot be undone.')}}
      </p>
    </div>
    <div class="w-full pt-4">
      <x-form.input x-mask="9999999" name="reimbursement" label="Reimbursement" placeholder="Reimbursement"
        :messages="$errors->get('reimbursement')" wire:model="reimbursement"
        class="w-full" />
    </div>

    <x-slot:footer>
      <x-secondary-button wire:click="$set('modal', false)">
        {{ __('Cancel') }}
      </x-secondary-button>

      <x-primary-button wire:click="cancel" class="ms-3">
        {{ __('Delete') }}
      </x-primary-button>
    </x-slot:footer>
  </x-modal>

  <x-toast on="show-toast" :$icon>
    {{ __( $msg ) }}
  </x-toast>
  @endif
</div>
