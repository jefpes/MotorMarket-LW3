<div>
  <x-modal wire:model="modal" name="group_modal">
    <x-slot:title> {{ __($title) }}: <span class="text-yellow-300">{{ $form->name ?? '' }}</span> </x-slot:title>

    <x-form.input name="name" label="Name" type="text" placeholder="Name" :messages="$errors->get('form.name')"
      wire:model="form.name" class="w-full" />

    <x-slot:footer>
      <x-secondary-button type="button" wire:click="cancel">
        {{ __('Cancel') }}
      </x-secondary-button>

      <x-primary-button wire:click="save" class="ms-3">
        {{ __('Update') }}
      </x-primary-button>

    </x-slot:footer>
  </x-modal>

  <x-toast on="show-toast" :$icon>
    {{ __( $msg ) }}
  </x-toast>
</div>
