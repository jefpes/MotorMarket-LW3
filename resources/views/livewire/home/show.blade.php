<section class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 py-2">
  <div class="container mx-auto flex items-center flex-wrap">
    <nav id="store" class="w-full z-30 top-0 px-6 py-1">
      <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
        <span class="uppercase tracking-wide no-underline hover:no-underline font-bold text-xl">
          {{ $vehicle->model->name . ' - ' . $vehicle->year_one.'/'.$vehicle->year_two }}
        </span>
      </div>
    </nav>

    @foreach ($vehicle->photos as $v)
      <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
        <img class="hover:grow hover:shadow-lg" src="{{ asset($v->path) }}">
      </div>
    @endforeach

    <div class="container mx-auto py-2 px-2 border-t border-gray-400">
      <div>
        <span class="font-bold text-gray-900 dark:text-gray-100">{{ __('Model') }}:</span>
        <span class="py-4">{{ $vehicle->model->name }}</span>
      </div>

      <div>
        <span class="font-bold text-gray-900 dark:text-gray-100">{{ __('Fuel') }}:</span>
        <span class="py-4">{{ $vehicle->fuel }}</span>
      </div>

      @if ($vehicle->steering)
        <div>
          <span class="font-bold text-gray-900 dark:text-gray-100">{{ __('Steering') }}:</span>
          <span class="py-4">{{ $vehicle->steering }}</span>
        </div>
      @endif

      @if ($vehicle->transmission)
        <div>
          <span class="font-bold text-gray-900 dark:text-gray-100">{{ __('Transmission') }}:</span>
          <span class="py-4">{{ $vehicle->transmission }}</span>
        </div>
      @endif

      @if ($vehicle->traction)
        <div>
          <span class="font-bold text-gray-900 dark:text-gray-100">{{ __('Traction') }}:</span>
          <span class="py-4">{{ $vehicle->traction }}</span>
        </div>
      @endif

      @if ($vehicle->doors)
        <div>
          <span class="font-bold text-gray-900 dark:text-gray-100">{{ __('Doors') }}:</span>
          <span class="py-4">{{ $vehicle->doors }}</span>
        </div>
      @endif

      @if ($vehicle->seats)
        <div>
          <span class="font-bold text-gray-900 dark:text-gray-100">{{ __('Seats') }}:</span>
          <span class="py-4">{{ $vehicle->seats }}</span>
        </div>
      @endif

      <div>
        <span class="font-bold text-gray-900 dark:text-gray-100">{{ __('Year') }}:</span>
        <span class="py-4">{{ $vehicle->year_one.'/'.$vehicle->year_two }}</span>
      </div>
      <div>
        <span class="font-bold text-gray-900 dark:text-gray-100">{{ __('KM') }}:</span>
        <span class="py-4">{{ $vehicle->km }}</span>
      </div>
      <div>
        <span class="font-bold text-gray-900 dark:text-gray-100">{{ __('Description') }}:</span>
        <span class="py-4">{{ $vehicle->description }}</span>
      </div>
      <div>
        @if ($vehicle->promotional_price)
          <p>
            <span class="font-bold text-gray-900 dark:text-gray-100">{{ __('Price') }}:</span>
            <x-span-money class="line-through py-4" :money="$vehicle->sale_price" />
          </p>
          <p>
            <span class="font-bold text-gray-900 dark:text-gray-100">{{ __('Promotional Price') }}:</span>
            <x-span-money class="py-4" :money="$vehicle->promotional_price" />
          </p>
        @else
          <span class="font-bold text-gray-900 dark:text-gray-100">{{ __('Price') }}:</span>
          <x-span-money class="py-4" :money="$vehicle->sale_price" />
        @endif
      </div>
    </div>

  </div>

</section>
