<section class="bg-white py-2">

  <div class="container mx-auto flex items-center flex-wrap">

    <nav id="store" class="w-full z-30 top-0 px-6 py-1">
      <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">

        <span class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl">
          {{ __('Store') }}
        </span>

        <div class="flex items-center">
          <button class="pl-3 inline-block no-underline hover:text-black" wire:click="$set('modal', true)">
            <svg class="fill-current hover:text-black w-6 h-6" viewBox="0 0 24 24">
              <path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z" />
            </svg>
          </button>
        </div>
      </div>

    </nav>

    @foreach ($this->vehicles as $v)
      <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
        <a href="{{ route('show.v', $v->id) }}">
          <img class="hover:grow hover:shadow-lg"
            src="{{ $v->photos->first()->path }}">
          <div class="pt-3 flex items-center justify-between">
            <p class="">{{ $v->model->name . ' - ' . $v->year_one.'/'.$v->year_two }}</p>
          </div>
          <p class="pt-1 text-gray-900">R$ {{ $v->sale_price }} </p>
        </a>
      </div>
    @endforeach
  </div>

  <div class="w-full container mx-auto px-2 justify-between">
    {{ $this->vehicles->onEachSide(1)->links() }}
  </div>

  <x-modal wire:model="modal" name="main_modal">
    <x-slot:title> {{ __('Filters') }} </x-slot:title>
    <div class="space-y-4">
      <div class="relative w-full bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <span
          class="bg-blue-200  font-medium text-blue-800 text-center p-0.5 leading-none rounded-full px-2 dark:bg-blue-900 dark:text-blue-200 absolute -translate-y-1/2 translate-x-1/2 right-1/2">
          {{ __('Brands') }}
        </span>
        <div class="w-full space-y-1 list-decimal list-inside text-gray-500 dark:text-gray-400 px-2 py-4 space-2">
          @foreach ($brands as $b)
          <label for="{{ $b->name }}" class="inline-flex items-center pr-2">
            <input id="{{ $b->name }}" wire:model.live="selectedBrands" type="checkbox"
              class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
              value="{{ $b->id }}">
            <span class="ms-1 text-sm text-gray-600 dark:text-gray-400">{{ $b->name }}</span>
          </label>
          @endforeach
        </div>
      </div>

      <div class="relative w-full bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <span class="bg-blue-200  font-medium text-blue-800 text-center p-0.5 leading-none rounded-full px-2 dark:bg-blue-900 dark:text-blue-200 absolute -translate-y-1/2 translate-x-1/2 right-1/2">
          {{ __('Price') }}
        </span>
        <div class="w-full space-y-1 list-decimal list-inside text-gray-500 dark:text-gray-400 px-2 py-4">
          <x-select wire:model.live="order" class="w-full" id="sold" label="Order">
            <option value="asc"> {{ __('Growing') }} </option>
            <option value="desc"> {{ __('Descending') }} </option>
          </x-select>
        </div>
      </div>

      <div class="relative w-full bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <span class="bg-blue-200  font-medium text-blue-800 text-center p-0.5 leading-none rounded-full px-2 dark:bg-blue-900 dark:text-blue-200 absolute -translate-y-1/2 translate-x-1/2 right-1/2">
          {{ __('Year') }}
        </span>
        <div class="w-full space-x-2 text-gray-500 dark:text-gray-400 px-2 py-4 flex">
          <x-select wire:model.live="year_ini" class="w-full" label="Year Initial">
            @for ($i = 1970; $i <= date('Y'); $i++)
              <option value="{{ $i }}"> {{ $i }} </option>
            @endfor
          </x-select>
          <x-select wire:model.live="year_end" class="w-full" label="Year End">
            @for ($i = 1970; $i <= date('Y'); $i++)
              <option value="{{ $i }}"> {{ $i }} </option>
            @endfor
          </x-select>
        </div>
      </div>
    </div>

    <x-slot:footer>
      <x-secondary-button type="button" wire:click="$set('modal', false)">
        {{ __('Close') }}
      </x-secondary-button>
    </x-slot:footer>
  </x-modal>
</section>
