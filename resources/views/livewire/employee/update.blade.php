<div>
  <x-slot name="header">{{ __($header) }}: <span class="text-yellow-300">{{ $employee->name }}</span></x-slot>

  <x-employee.create-update :$states :$cities :$maritalStatus />

  <div class="flex items-center mt-4 pt-2 border-t border-gray-200 rounded-b dark:border-gray-600 justify-end">
    <x-secondary-button href="{{ route('client') }}" wire:navigate> {{ __('Back') }} </x-secondary-button>

    <x-primary-button wire:click="save" class="ms-3"> {{ __('Save') }} </x-primary-button>
  </div>

  <x-toast on="show-toast" :$icon> {{ __( $msg ) }} </x-toast>
</div>
