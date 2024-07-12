<div>
<x-modal name="modal" wire:model="modal" focusable>
  <x-slot name="title">Nome: {{ $form->name }}</x-slot>

  <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
    {{ __('Are you sure you want to enable this account?') }}
  </h2>

  <x-slot name="footer">
    <x-secondary-button type='button' wire:click="cancel">
      {{ __('Cancel') }}
    </x-secondary-button>

    <x-primary-button class="ms-3" wire:click='active'>
      {{ __('Activate') }}
    </x-primary-button>
  </x-slot>
</x-modal>

<x-toast :$msg :$icon />

</div>
