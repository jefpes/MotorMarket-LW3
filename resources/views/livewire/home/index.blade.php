<section class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 py-2">
  <div class="container mx-auto flex items-center flex-wrap">

    <nav id="store" class="w-full px-6 py-1">
      <div class="w-full container mx-auto flex flex-wrap justify-between mt-0 px-2 py-3">

        <span class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 dark:text-gray-200 text-xl">
          {{ __('Store') }}
        </span>

        <x-icons.filter class="cursor-pointer w-6 h-6 text-gray-800 hover:text-blue-500 dark:text-gray-200 dark:hover:text-blue-500" wire:click="$set('modal', true)"/>
      </div>

    </nav>
    <div class="flex flex-wrap gap-4 py-2 w-full">
      @foreach ($this->vehicles as $v)
        <div class="w-full sm:w-[48%] md:w-[30%] xl:w-[24%] p-1 rounded-md border-2 border-gray-300 dark:border-gray-600">
          <a href="{{ route('show.v', $v->id) }}">
            <img class="hover:grow hover:shadow-lg w-full sm:w-auto sm:h-60 rounded-md" src="{{ $v->photos->first()->path }}">
            <div class="pt-3 flex items-center justify-between">
              <p class="">{{ $v->model->name . ' - ' . $v->year_one.'/'.$v->year_two }}</p>
            </div>
            <p class="pt-1">R$ {{ $v->sale_price }} </p>
          </a>
        </div>
      @endforeach
    </div>
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
          @foreach ($this->brands as $b)
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
        <span
          class="bg-blue-200  font-medium text-blue-800 text-center p-0.5 leading-none rounded-full px-2 dark:bg-blue-900 dark:text-blue-200 absolute -translate-y-1/2 translate-x-1/2 right-1/2">
          {{ __('Price') }}
        </span>
        <div class="flex w-full text-gray-500 dark:text-gray-400 px-2 py-4 gap-x-2">
          <div class="flex-1">
            <x-select wire:model.live="order" id="sold" label="Order" class="w-full">
              <option value="asc"> {{ __('Growing') }} </option>
              <option value="desc"> {{ __('Descending') }} </option>
            </x-select>
          </div>
          <div class="flex-1">
            <x-select wire:model.live="max_price" class="w-full" id="max_price" label="Max Price">
              <option value=""> {{ __('All') }} </option>
              @for ($i = 10000; $i <= ($max_prices+10000); $i+=10000) <option value="{{ $i }}"> {{ $i }} </option>
                @endfor
            </x-select>
          </div>
        </div>
      </div>

      <div class="relative w-full bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <span
          class="bg-blue-200  font-medium text-blue-800 text-center p-0.5 leading-none rounded-full px-2 dark:bg-blue-900 dark:text-blue-200 absolute -translate-y-1/2 translate-x-1/2 right-1/2">
          {{ __('Year') }}
        </span>
        <div class="w-full space-x-2 text-gray-500 dark:text-gray-400 px-2 py-4 flex">
          <div class="flex-1">
            <x-select wire:model.live="year_ini" class="w-full" label="Year Initial">
              @for ($i = $year_min; $i <= $year_max; $i++) <option value="{{ $i }}"> {{ $i }} </option> @endfor
            </x-select>
          </div>
          <div class="flex-1">
            <x-select wire:model.live="year_end" class="w-full" label="Year Final">
              @for ($i = $year_min; $i <= $year_max; $i++) <option value="{{ $i }}"> {{ $i }} </option> @endfor
            </x-select>
          </div>
        </div>
      </div>

      <div class="relative w-full bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <span
          class="bg-blue-200  font-medium text-blue-800 text-center p-0.5 leading-none rounded-full px-2 dark:bg-blue-900 dark:text-blue-200 absolute -translate-y-1/2 translate-x-1/2 right-1/2">
          {{ __('Type') }}
        </span>

        <div class="w-full space-y-1 text-gray-500 dark:text-gray-400 px-2 py-4">

          <x-select wire:model.live="type" class="w-full" label="Type">
            <option value=""> {{ __('All') }} </option>
            @foreach ($types as $t)
            <option value="{{ $t->id }}"> {{ $t->name }} </option>
            @endforeach
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
