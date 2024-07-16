<div>
  <x-primary-button type='button' wire:click="$set('modal', true)"> {{ __('New Expense') }} </x-primary-button>

  <x-modal wire:model="modal" name="expense_create_modal">
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

  <x-toast :$msg :$icon />
</div>
