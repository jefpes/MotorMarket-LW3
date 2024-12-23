<div x-data="{
    currentSlide: 0,
    slides: {{ $vehicle->photos->count() }},
    showLargeImage: false,
    activeImage: ''
}" class="space-y-8">
  <h1 class="text-3xl font-bold">{{ $vehicle->model->name . ' - ' . $vehicle->year_one.'/'.$vehicle->year_two }}</h1>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div class="space-y-4">
      <!-- Carrossel personalizado -->
      <div class="relative overflow-hidden rounded-md">
        <div class="flex transition-transform duration-300 ease-in-out"
          :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
          @foreach ($vehicle->photos as $index => $photo)
          <div class="w-full flex-shrink-0">
            <div class="aspect-w-16 aspect-h-9">
              <img src="{{ asset($photo->path) }}"
                class="object-fill w-full h-full cursor-pointer max-h-[60vh] md:max-h-[50vh]"
                @click="showLargeImage = true; activeImage = '{{ asset($photo->path) }}'">
            </div>
          </div>
          @endforeach
        </div>
        <button @click="currentSlide = (currentSlide - 1 + slides) % slides"
          class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-r">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
        </button>
        <button @click="currentSlide = (currentSlide + 1) % slides"
          class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-l">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </button>
      </div>
      <!-- Indicadores do carrossel -->
      <div class="flex justify-center space-x-2">
        @foreach ($vehicle->photos as $index => $photo)
        <button @click="currentSlide = {{ $index }}"
          :class="{'bg-blue-600': currentSlide === {{ $index }}, 'bg-gray-300': currentSlide !== {{ $index }}}"
          class="w-3 h-3 rounded-full focus:outline-none"></button>
        @endforeach
      </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
      <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold">{{ __('Details') }}</h2>
        @if($vehicle->promotional_price)
        <div class="text-right">
          <p class="text-sm text-gray-500 line-through">
            <x-span-money :money="$vehicle->sale_price" />
          </p>
          <p class="text-2xl font-bold text-green-600">
            <x-span-money :money="$vehicle->promotional_price" />
          </p>
        </div>
        @else
        <p class="text-2xl font-bold">
          <x-span-money :money="$vehicle->sale_price" />
        </p>
        @endif
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <p class="text-gray-500">{{ __('Model') }}</p>
          <p class="font-medium">{{ $vehicle->model->name }} {{ $vehicle->engine_power }}</p>
        </div>
        <div>
          <p class="text-gray-500">{{ __('Fuel') }}</p>
          <p class="font-medium">{{ $vehicle->fuel }}</p>
        </div>
        @if ($vehicle->steering)
        <div>
          <p class="text-gray-500">{{ __('Steering') }}</p>
          <p class="font-medium">{{ $vehicle->steering }}</p>
        </div>
        @endif
        @if ($vehicle->transmission)
        <div>
          <p class="text-gray-500">{{ __('Transmission') }}</p>
          <p class="font-medium">{{ $vehicle->transmission }}</p>
        </div>
        @endif
        @if ($vehicle->traction)
        <div>
          <p class="text-gray-500">{{ __('Traction') }}</p>
          <p class="font-medium">{{ $vehicle->traction }}</p>
        </div>
        @endif
        @if ($vehicle->doors)
        <div>
          <p class="text-gray-500">{{ __('Doors') }}</p>
          <p class="font-medium">{{ $vehicle->doors }}</p>
        </div>
        @endif
        @if ($vehicle->seats)
        <div>
          <p class="text-gray-500">{{ __('Seats') }}</p>
          <p class="font-medium">{{ $vehicle->seats }}</p>
        </div>
        @endif
        <div>
          <p class="text-gray-500">{{ __('Year') }}</p>
          <p class="font-medium">{{ $vehicle->year_one.'/'.$vehicle->year_two }}</p>
        </div>
        <div>
          <p class="text-gray-500">{{ __('KM') }}</p>
          <p class="font-medium">{{ number_format($vehicle->km, 0, ',', '.') }}</p>
        </div>
      </div>

      <div>
        <h3 class="text-xl font-semibold mb-2">{{ __('Description') }}</h3>
        <p class="text-gray-600">{{ $vehicle->description }}</p>
      </div>

      @if (false)
        <div class="pt-6 border-t border-gray-200">
          <button
          class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors duration-200">
          {{ __('Contact Seller') }}
          </button>
        </div>
      @endif
    </div>
  </div>

  <!-- Modal para imagem ampliada -->
  <div x-show="showLargeImage" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75"
    @click.away="showLargeImage = false">
    <div class="relative max-w-4xl max-h-full">
      <img :src="activeImage" :alt="'{{ $vehicle->model->name }}'" class="object-contain w-full h-full">
      <button @click="showLargeImage = false" class="absolute top-4 right-4 text-white hover:text-gray-300">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
  </div>
</div>
