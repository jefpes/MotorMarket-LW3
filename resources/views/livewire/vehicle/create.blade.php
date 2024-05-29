<div>
  <x-slot name="header">{{ __($header) }}</x-slot>
  <x-vehicle.create-update />

  <div class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600 justify-end">
    <x-secondary-button :href="route('vehicle')" wire:navigate>
      {{ __('Back') }}
    </x-secondary-button>

    <x-primary-button wire:click="save" class="ms-3">
      {{ __('Save') }}
    </x-primary-button>
  </div>

  <x-toast on="show-toast" :$icon> {{ __( $msg ) }} </x-toast>
</div>
