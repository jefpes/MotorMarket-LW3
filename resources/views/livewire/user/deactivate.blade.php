<div>
<x-modal name="modal" wire:model="modal" focusable>
  <x-slot name="title">{{ __('Name') }}: {{ $form->name }}</x-slot>

  <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
    {{ __('Are you sure you want to disable this account?') }}
  </h2>

  <x-slot name="footer">
    <x-secondary-button type='button' wire:click="cancel">
      {{ __('Cancel') }}
    </x-secondary-button>

    <x-danger-button class="ms-3" wire:click='deactive'>
      {{ __('Deactivate') }}
    </x-danger-button>
  </x-slot>
</x-modal>

<x-toast :$msg :$icon />

</div>
