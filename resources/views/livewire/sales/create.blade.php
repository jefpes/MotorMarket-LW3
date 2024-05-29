<div>
  <x-slot name="header"> {{ __($header) }} </x-slot>

  <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
    <span class="font-medium">{{ __('Vehicle') }} </span> {{ $vehicle->plate . $vehicle->model->name }} {{ __('has been successfully created') }}
  </div>
</div>
