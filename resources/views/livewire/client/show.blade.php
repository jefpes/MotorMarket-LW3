<div>
  <x-slot name="header">{{ __($header) }}: <span class="text-yellow-300">{{ $client->name ?? 'People'}}</span></x-slot>

      <div class="flex overflow-x-auto pb-4">
        @forelse ($client->photos as $photo)
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
          {{ $client->name }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('RG') }}: </span>
          {{ $client->rg }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('CPF') }}: </span>
          {{ $client->cpf }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Phone') }} (1): </span>
          {{ $client->phone_one }}
        </p>
      </div>
      @isset($client->phone_two)
        <div class="flex">
          <p class="text-lg font-semibold">
            <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Phone') }} (2): </span>
            {{ $client->phone_two }}
          </p>
        </div>
      @endisset
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Date Birth') }}: </span>
          {{ $client->birth_date }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Mother') }}: </span>
          {{ $client->mother }}
        </p>
      </div>
      @isset($client->father)
        <div class="flex">
          <p class="text-lg font-semibold">
            <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Father') }}: </span>
            {{ $client->father }}
          </p>
        </div>
      @endisset
      @isset($client->affiliated_one)
        <div class="flex">
          <p class="text-lg font-semibold">
            <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Affiliated') }} (1): </span>
            {{ $client->affiliated_one }}
          </p>
        </div>
      @endisset
      @isset($client->affiliated_two)
        <div class="flex">
          <p class="text-lg font-semibold">
            <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Affiliated') }} (2): </span>
            {{ $client->affiliated_two }}
          </p>
        </div>
      @endisset
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Description') }}: </span>
          {{ $client->description }}
        </p>
      </div>

      <div class="inline-flex items-center justify-center w-full">
        <hr class="w-full h-1 my-8 bg-gray-200 border-0 rounded dark:bg-gray-700">
        <div class="absolute px-4 -translate-x-1/2 bg-white left-1/2 dark:bg-gray-800">
          {{ __('Address') }}
        </div>
      </div>

      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Country') }}: </span>
          {{ $client->country }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('State') }}: </span>
          {{ $client->state }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('City') }}: </span>
          {{ $client->city->name }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Bairro') }}: </span>
          {{ $client->bairro }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('CEP') }}: </span>
          {{ $client->cep }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Logradouro') }}: </span>
          {{ $client->logradouro_type }} {{ $client->logradouro }}, {{ $client->number }}
        </p>
      </div>
      @isset($client->complement)
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Complement') }}: </span>
          {{ $client->complement }}
        </p>
      </div>
      @endisset
    </dl>
  </div>
  <div class="flex pt-4 items-center border-t border-gray-200 rounded-b dark:border-gray-600 justify-end gap-x-2">
    <x-secondary-button :href="route('client')" wire:navigate> {{ __('Back') }} </x-secondary-button>
    @can('client_update')
      <x-primary-button :href="route('client.edit', $client->id)" wire:navigate> {{ __('Edit') }} </x-primary-button>
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