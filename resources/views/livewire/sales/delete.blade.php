<div>
  @if ($sale)
  <x-modal wire:model="modal" name="delete_sale_modal_{{ $sale->id }}">
    <x-slot:title>
      {{ __('Deleting Sale') }}: <span class="text-yellow-300">{{ $sale->date_sale }}</span>
    </x-slot:title>
    <div class="w-full">
      <p>
        {{__('This operation cannot be undone.')}}
      </p>
    </div>

    <x-slot:footer>
      <x-secondary-button wire:click="$set('modal', false)">
        {{ __('Cancel') }}
      </x-secondary-button>

      <x-primary-button wire:click="destroy" class="ms-3">
        {{ __('Delete') }}
      </x-primary-button>
    </x-slot:footer>
  </x-modal>

  <x-toast on="show-toast" :$icon>
    {{ __( $msg ) }}
  </x-toast>
  @endif
</div>
