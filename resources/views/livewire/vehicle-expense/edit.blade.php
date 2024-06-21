<div>
  <x-modal wire:model="modal" name="edit_role_modal_{{ $form->id }}">
    <x-slot:title> {{ __($title) }}</x-slot:title>

    <x-vehicle-expense.create-update />

    <x-slot:footer>
      <x-secondary-button wire:click="$set('modal', false)"> {{ __('Cancel') }} </x-secondary-button>

      <x-primary-button wire:click="save" class="ms-3"> {{ __('Update') }} </x-primary-button>
    </x-slot:footer>
  </x-modal>

  <x-toast on="show-toast" :$icon>
    {{ __( $msg ) }}
  </x-toast>
</div>
