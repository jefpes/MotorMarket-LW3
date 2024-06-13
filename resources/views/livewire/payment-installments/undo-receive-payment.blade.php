<div>
  <x-modal wire:model="modal" name="main_modal">
    <x-slot:title> {{ __($title) }} </x-slot:title>
    <div class="w-full">
      <p> {{__('This operation cannot be undone.')}} </p>
    </div>

    <x-slot:footer>
      <x-secondary-button wire:click="cancel">
        {{ __('Cancel') }}
      </x-secondary-button>

      <x-danger-button wire:click="undo" class="ms-3">
        {{ __('Reverse') }}
      </x-danger-button>
    </x-slot:footer>
  </x-modal>

  <x-toast on="show-toast" :$icon>
    {{ __( $msg ) }}
  </x-toast>
</div>
