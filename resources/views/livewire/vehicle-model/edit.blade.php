<div>
  <x-modal wire:model="modal" name="edit_role_modal_{{ $form->id }}">
    <x-slot:title> {{ __('Edit Vehicle Model') }}: <span class="text-yellow-300">{{ $form->name }}</span> </x-slot:title>

    <x-vmodel.create-update />

    <x-slot:footer>
      <x-secondary-button wire:click="$set('modal', false)"> {{ __('Cancel') }} </x-secondary-button>

      <x-primary-button wire:click="save" class="ms-3"> {{ __('Update') }} </x-primary-button>
    </x-slot:footer>
  </x-modal>

  <x-toast :$msg :$icon />
</div>
