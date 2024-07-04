<div>
  <x-slot name="header"> {{__('Edit user')}}: {{ $form->name }} </x-slot>

  <x-user.create-update :$employees />

  <div class="flex justify-end border-t pt-4">

    <x-secondary-button href="{{ route('users') }}" wire:navigate> {{ __('Back') }} </x-secondary-button>
    <x-primary-button wire:click="save" class="ms-3"> {{ __('Save') }} </x-primary-button>

  </div>
</div>
