<div>
  <x-slot name="header">{{ __($header) }}: <span class="text-yellow-300">{{ $people->name ?? 'People'}}</span></x-slot>

      <div class="flex overflow-x-auto pb-4">
        @forelse ($people->photos as $photo)
          <img wire:click="actions({{ $photo->id }})" class="cursor-pointer w-full md:max-w-sm mx-auto max-h-[60vh]" src="../{{ $photo->path }}">
        @empty
          <p class="text-center text-2xl text-red-400" >{{ __('No photos available.') }}</p>
        @endforelse
      </div>
  <div class="p-2 border-t border-gray-200 dark:border-gray-700">
    <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Name') }}: </span>
          {{ $people->name }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold"> <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Surname') }}: </span> {{ $people->surname }} </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Date Birth') }}: </span>
          {{ $people->date_birth }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Name Mother') }}: </span>
          {{ $people->name_mother }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Description') }}: </span>
          {{ $people->description }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Address') }}: </span>
          {{ $people->address }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('City') }}: </span>
          {{ $people->city->name }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Group') }}: </span> {{ $people->group->name }}
        </p>
      </div>
    </dl>
  </div>
  <div class="flex pt-4 items-center border-t border-gray-200 rounded-b dark:border-gray-600 justify-end gap-x-2">
    <x-secondary-button :href="route('people')" wire:navigate> {{ __('Back') }} </x-secondary-button>
    @can('people_update')
      <x-primary-button :href="route('people.edit', $people->id)" wire:navigate> {{ __('Edit') }} </x-primary-button>
    @endcan
  </div>

  <x-modal wire:model="modal" name="modal">
    <x-slot:title> {{ __('Options') }} </x-slot:title>
    <div class="w-full">
      <p> {{__('Select action wished.')}} </p>
    </div>

    <x-slot:footer>
      <x-secondary-button wire:click="cancel">
        {{ __('Back') }}
      </x-secondary-button>

      <x-primary-button wire:click="download" class="ms-3">
        {{ __('Download') }}
      </x-primary-button>

      @can('photo_delete')
        <x-danger-button wire:click="destroy" class="ms-3">
          {{ __('Delete') }}
        </x-danger-button>
      @endcan
    </x-slot:footer>
  </x-modal>

  <x-toast on="show-toast" :$icon>
    {{ __( $msg ) }}
  </x-toast>
</div>
