<div>
  <x-modal wire:model="modal" name="main_modal">
    <x-slot:title>
      {{ __($title) }}: <span class="text-yellow-300">{{ $form->name }}</span>
    </x-slot:title>
    <div class="w-full">
      <p>
        {{__('This operation cannot be undone.')}}
      </p>
    </div>

    <x-slot:footer>
      <x-secondary-button wire:click="cancel">
        {{ __('Cancel') }}
      </x-secondary-button>

      <x-danger-button wire:click="destroy" class="ms-3">
        {{ __('Delete') }}
      </x-danger-button>
    </x-slot:footer>
  </x-modal>

  <x-toast :$msg :$icon />
</div>
