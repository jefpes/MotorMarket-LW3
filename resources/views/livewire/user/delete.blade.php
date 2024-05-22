<div>
<x-modal name="modal" wire:model="modal" focusable>
  <x-slot name="title">Nome: {{ $form->name }}</x-slot>

  <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
    {{ __('Are you sure you want to delete your account?') }}
  </h2>

  <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
    {{ __('This operation cannot be undone.') }}
  </p>

  <x-slot name="footer">
    <x-secondary-button type='button' wire:click="cancel">
      {{ __('Cancel') }}
    </x-secondary-button>

    <x-danger-button class="ms-3" wire:click='destroy'>
      {{ __('Delete') }}
    </x-danger-button>
  </x-slot>
</x-modal>

<x-toast on="show-toast" :$icon> {{ __( $msg ) }} </x-toast>

</div>
