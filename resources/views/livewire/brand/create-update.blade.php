<div>
  <x-modal wire:model="modal" name="main_modal">
    <x-slot:title> {{ __($title) }}
    @if ($form->name)
      : <span class="text-yellow-300">{{ $form->name }}
    @endif
    </x-slot:title>

    <x-form.input name="name" label="Name" type="text" placeholder="Name" :messages="$errors->get('form.name')"
      wire:model="form.name" class="w-full" />

    <x-slot:footer>
      <x-secondary-button type="button" wire:click="cancel">
        {{ __('Cancel') }}
      </x-secondary-button>

     <x-primary-button wire:click="save" class="ms-3">
        {{ __('Save') }}
      </x-primary-button>
    </x-slot:footer>
  </x-modal>

  <x-toast :$msg :$icon />
</div>
