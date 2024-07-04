<div>
<x-modal name="modal" wire:model="modal" focusable>
  <x-slot name="title">Nome: {{ $form->name }}</x-slot>

  <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
    {{ __('Are you sure you want to disable this account?') }}
  </h2>

  <x-slot name="footer">
    <x-secondary-button type='button' wire:click="cancel">
      {{ __('Cancel') }}
    </x-secondary-button>

    <x-danger-button class="ms-3" wire:click='deactive'>
      {{ __('Desable') }}
    </x-danger-button>
  </x-slot>
</x-modal>

<x-toast on="show-toast" :$icon> {{ __( $msg ) }} </x-toast>

</div>
