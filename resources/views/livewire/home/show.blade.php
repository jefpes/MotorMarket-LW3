<section class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 py-2">
  <div class="container mx-auto flex items-center flex-wrap">
    <div class="w-full mx-auto flex flex-wrap items-center justify-center mt-0 px-2 py-3">
      <span class="tracking-wide font-bold text-xl">
        {{ $vehicle->model->name . ' - ' . $vehicle->year_one.'/'.$vehicle->year_two }}
      </span>
    </div>

    @foreach ($vehicle->photos as $v)
      <div class="w-full md:w-1/3 xl:w-1/4 py-2 md:px-2 flex flex-col">
        <img class="hover:grow shadow-md shadow-green-300 md:rounded-xl object-fill max-h-[60vh] md:max-h-[50vh]" src="{{ asset($v->path) }}">
      </div>
    @endforeach

    <div class="container mx-auto py-2 px-2 border-t border-gray-400">
      <div class=" bg-white rounded-lg dark:bg-gray-800">
        <dl class="grid gap-2 sm:gap-6 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-6 dark:text-white p-4">
          <div class="flex flex-col items-center justify-center">
            <dd class="text-gray-500 dark:text-gray-400">{{ __('Model') }}</dd>
            <dt class="text-2xl font-extrabold">{{ $vehicle->model->name }} {{ $vehicle->engine_power }}</dt>
          </div>
          <div class="flex flex-col items-center justify-center">
            <dd class="text-gray-500 dark:text-gray-400">{{ __('Fuel') }}</dd>
            <dt class="text-2xl font-extrabold">{{ $vehicle->fuel }}</dt>
          </div>
          @if ($vehicle->steering)
            <div class="flex flex-col items-center justify-center">
              <dd class="text-gray-500 dark:text-gray-400">{{ __('Steering') }}</dd>
              <dt class="text-2xl font-extrabold">{{ $vehicle->steering }}</dt>
            </div>
          @endif
          @if ($vehicle->transmission)
            <div class="flex flex-col items-center justify-center">
              <dd class="text-gray-500 dark:text-gray-400">{{ __('Transmission') }}</dd>
              <dt class="text-2xl font-extrabold">{{ $vehicle->transmission }}</dt>
            </div>
          @endif
          @if ($vehicle->traction)
            <div class="flex flex-col items-center justify-center">
              <dd class="text-gray-500 dark:text-gray-400">{{ __('Traction') }}</dd>
              <dt class="text-2xl font-extrabold">{{ $vehicle->traction }}</dt>
            </div>
          @endif
          @if ($vehicle->doors)
            <div class="flex flex-col items-center justify-center">
              <dd class="text-gray-500 dark:text-gray-400">{{ __('Doors') }}</dd>
              <dt class="text-2xl font-extrabold">{{ $vehicle->doors }}</dt>
            </div>
          @endif
          @if ($vehicle->seats)
            <div class="flex flex-col items-center justify-center">
              <dd class="text-gray-500 dark:text-gray-400">{{ __('Seats') }}</dd>
              <dt class="text-2xl font-extrabold">{{ $vehicle->seats }}</dt>
            </div>
          @endif
          <div class="flex flex-col items-center justify-center">
            <dd class="text-gray-500 dark:text-gray-400">{{ __('Year') }}</dd>
            <dt class="text-2xl font-extrabold">{{ $vehicle->year_one.'/'.$vehicle->year_two }}</dt>
          </div>
          <div class="flex flex-col items-center justify-center">
            <dd class="text-gray-500 dark:text-gray-400">{{ __('KM') }}</dd>
            <dt class="text-2xl font-extrabold">{{ $vehicle->km }}</dt>
          </div>
          @if ($vehicle->promotional_price)
            <div class="flex flex-col items-center justify-center text-green-500 dark:text-green-400">
              <dd>{{ __('Promotional Price') }}</dd>
              <dt class="text-2xl font-extrabold">
                <x-span-money :money="$vehicle->promotional_price" />
              </dt>
            </div>
            @else
            <div class="flex flex-col items-center justify-center">
              <dd class="text-gray-500 dark:text-gray-400">{{ __('Price') }}</dd>
              <dt class="text-2xl font-extrabold">
                <x-span-money :money="$vehicle->sale_price" />
              </dt>
            </div>
          @endif
        </dl>
        <div class="p-4">
          <div class="flex flex-col items-center justify-center">
            <dd class="text-gray-500 dark:text-gray-400">{{ __('Description') }}</dd>
            <dt class="text-2xl font-extrabold">{{ $vehicle->description }}</dt>
          </div>
        </div>
      </div>
    </div>

  </div>

</section>
