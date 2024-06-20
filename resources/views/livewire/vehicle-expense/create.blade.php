<div>
  <x-primary-button type='button' wire:click="$set('modal', true)" class="text-[1em] tracking-normal"> {{ __('Expense') }} </x-primary-button>

  <x-modal wire:model="modal" name="amodal">
    <x-slot:title> {{ __($title) }} </x-slot:title>

    <x-vehicle-expense.create-update />

    <x-slot:footer>
      <x-secondary-button wire:click="cancel">
        {{ __('Cancel') }}
      </x-secondary-button>

      <x-primary-button wire:click="save" class="ms-3">
        {{ __('Save') }}
      </x-primary-button>
    </x-slot:footer>
  </x-modal>

  <x-toast on="show-toast-2" :$icon>
    {{ __($msg) }}
  </x-toast>
</div>
