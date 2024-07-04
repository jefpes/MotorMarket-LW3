<div>
  <x-slot name="header"> {{ __('Create new user') }} </x-slot>

  <x-user.create-update :$employees />

  <div class="flex justify-end border-t pt-4">

    <a href="{{ route('users') }}" wire:navigate> <x-secondary-button type="button"> {{ __('Back') }} </x-secondary-button> </a>

    <x-primary-button wire:click="save" class="ms-3"> {{ __('Save') }} </x-primary-button>

  </div>

  <x-toast on="show-toast" :$icon>
    {{ __( $msg ) }}
  </x-toast>
</div>
