<div>
  <x-slot name="header">{{ __($header) }}</x-slot>

  <x-employee.create-update :$states :$cities :$maritalStatus />

  <x-toast on="show-toast" :$icon> {{ __( $msg ) }} </x-toast>
</div>
