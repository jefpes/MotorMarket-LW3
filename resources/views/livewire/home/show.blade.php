<section class="bg-white py-2">

  <div class="container mx-auto flex items-center flex-wrap">

    <nav id="store" class="w-full z-30 top-0 px-6 py-1">
      <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
        <span class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl">
          {{ $vehicle->model->name . ' - ' . $vehicle->year_one.'/'.$vehicle->year_two }}
        </span>
      </div>
    </nav>

    @foreach ($vehicle->photos as $v)
      <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
        <img class="hover:grow hover:shadow-lg" src="../{{ $v->path }}">
      </div>
    @endforeach
<div class="container mx-auto bg-white py-2 px-2 border-t border-gray-400">
  <div>
    <span class="font-bold text-gray-900">{{ __('Model') }}:</span>
    <span class="py-4">{{ $vehicle->model->name }}</span>
  </div>
  <div>
    <span class="font-bold text-gray-900">{{ __('Year') }}:</span>
    <span class="py-4">{{ $vehicle->year_one.'/'.$vehicle->year_two }}</span>
  </div>
  <div>
    <span class="font-bold text-gray-900">{{ __('KM') }}:</span>
    <span class="py-4">{{ $vehicle->km }}</span>
  </div>
  <div>
    <span class="font-bold text-gray-900">{{ __('Description') }}:</span>
    <span class="py-4">{{ $vehicle->description }}</span>
  </div>
  <div>
    <span class="font-bold text-gray-900">{{ __('Value') }}:</span>
    <span class="py-4">R$ {{ $vehicle->sale_price }}</span>
  </div>
</div>

  </div>

</section>
