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
    <div class="flex flex-wrap justify-center gap-4 py-2">
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

   <x-select wire:model.live="brand" class="w-full" label="Brand">
    <option value=""> {{ __('All') }} </option>
    @foreach ($this->brands as $data)
    <option value="{{ $data->id }}"> {{ $data->name }} </option>
    @endforeach
  </x-select>

  <x-select wire:model.live="type" class="w-full" label="Type">
    <option value=""> {{ __('All') }} </option>
    @foreach ($types as $t)
    <option value="{{ $t->id }}"> {{ $t->name }} </option>
    @endforeach
  </x-select>

  <x-select wire:model.live="order" id="sold" label="Order" class="w-full">
    <option value="asc"> {{ __('Growing') }} </option>
    <option value="desc"> {{ __('Descending') }} </option>
  </x-select>

  <x-select wire:model.live="max_price" class="w-full" id="max_price" label="Max Price">
    <option value=""> {{ __('All') }} </option>
    @for ($i = 10000; $i <= ($max_prices+10000); $i+=10000) <option value="{{ $i }}"> {{ $i }} </option>
      @endfor
  </x-select>

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

    <x-slot:footer>
      <x-secondary-button type="button" wire:click="cancel">
        {{ __('Cancel') }}
      </x-secondary-button>
    </x-slot:footer>
  </x-modal>

</section>
