<div class="w-full sm:w-[48%] md:w-[30%] xl:w-[24%] p-1">
  <a href="{{ route('show.v', $v->id) }}"
    class="block rounded-lg p-2 shadow-md shadow-green-300 dark:bg-gray-800 bg-gray-200 hover:grow">
    <div class="h-56 w-full">
      <img src="{{ $v->photos->first()->path }}" class="h-full w-full rounded-md object-fill" />
    </div>

    <div class="mt-2">
      <dl>
        <div>
          <dt class="sr-only">{{ __('Price') }}</dt>
          @if($v->promotional_price)
          <div class="flex justify-between items-center">
            <dd class="text-xs text-red-400 line-through">
              <x-span-money :money="$v->sale_price" class="font-medium" />
            </dd>
            <dd class="text-xl text-green-600">
              <x-span-money :money="$v->promotional_price" class="font-medium" />
            </dd>
          </div>
          @else
          <dd>
            <x-span-money :money="$v->sale_price" class="font-medium" />
          </dd>
          @endif
        </div>
      </dl>

      <div class="flex items-center justify-between text-xs">
        <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
          <div class="mt-1 sm:mt-0">
            <p class="text-gray-500">{{ __('Brand') }}</p>

            <p class="font-medium">{{ $v->model->brand->name }}</p>
          </div>
        </div>

        <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
          <div class="mt-1 sm:mt-0">
            <p class="text-gray-500">{{ __('Model') }}</p>

            <p class="font-medium">{{ $v->model->name }}</p>
          </div>
        </div>

        <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
          <div class="mt-1 sm:mt-0">
            <p class="text-gray-500">{{ __('Year') }}</p>

            <p class="font-medium">{{ $v->year_one.'/'.$v->year_two }}</p>
          </div>
        </div>

        <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
          <div class="mt-1 sm:mt-0">
            <p class="text-gray-500">{{ __('KM') }}</p>

            <p class="font-medium">{{ $v->km }}</p>
          </div>
        </div>
      </div>
    </div>
  </a>
</div>
