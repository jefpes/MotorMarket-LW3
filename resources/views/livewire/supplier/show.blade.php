<div>
  <x-slot name="header">{{ __($header) }}: <span class="text-yellow-300">{{ $entity->name ?? 'People'}}</span></x-slot>

  <div class="flex overflow-x-auto pb-4">
    @forelse ($entity->photos as $photo)
      <img wire:click="actions({{ $photo->id }})" class="cursor-pointer w-full md:max-w-sm mx-auto max-h-[60vh]" src="../{{ $photo->path }}">
    @empty
      <p class="text-center text-2xl text-red-400" >{{ __('No photo available') }}</p>
    @endforelse
  </div>

  <div class="p-2 border-t border-gray-200 dark:border-gray-700">
    <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Name') }}: </span>
          {{ $entity->name }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('RG') }}: </span>
          {{ $entity->rg }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('CPF') }}: </span>
          {{ $entity->cpf }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Date Birth') }}: </span>
          <x-span-date :date="$entity->birth_date" />
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Mother') }}: </span>
          {{ $entity->mother }}
        </p>
      </div>
      @if($entity->father)
        <div class="flex">
          <p class="text-lg font-semibold">
            <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Father') }}: </span>
            {{ $entity->father }}
          </p>
        </div>
      @endif
      @if($entity->affiliated_one)
        <div class="flex">
          <p class="text-lg font-semibold">
            <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Affiliated') }} @if($entity->affiliated_two) (1) @endif: </span>
            {{ $entity->affiliated_one }}
          </p>
        </div>
      @endif
      @if($entity->affiliated_two)
        <div class="flex">
          <p class="text-lg font-semibold">
            <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Affiliated') }} (2): </span>
            {{ $entity->affiliated_two }}
          </p>
        </div>
      @endif
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Description') }}: </span>
          {{ $entity->description }}
        </p>
      </div>

      <div class="inline-flex items-center justify-center w-full">
        <hr class="w-full h-1 my-8 bg-gray-200 border-0 rounded dark:bg-gray-700">
        <div class="absolute px-4 -translate-x-1/2 bg-white left-1/2 dark:bg-gray-800">
          {{ __('Contacts') }}
        </div>
      </div>

      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Phone') }}
            @if($entity->phone_two)(1)@endif: </span>
          {{ $entity->phone_one }}
        </p>
      </div>
      @if($entity->phone_two)
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Phone') }} (2): </span>
          {{ $entity->phone_two }}
        </p>
      </div>
      @endif

      <div class="inline-flex items-center justify-center w-full">
        <hr class="w-full h-1 my-8 bg-gray-200 border-0 rounded dark:bg-gray-700">
        <div class="absolute px-4 -translate-x-1/2 bg-white left-1/2 dark:bg-gray-800">
          {{ __('Address') }}
        </div>
      </div>

      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('State') }}: </span>
          {{ $entity->address->state ?? ''}}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('City') }}: </span>
          {{ $entity->address->city->name ?? '' }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Bairro') }}: </span>
          {{ $entity->address->neighborhood ?? ''}}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('CEP') }}: </span>
          {{ $entity->address->zip_code ?? ''}}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Logradouro') }}: </span>
          {{ $entity->address->street }}, {{ $entity->address->number }}
        </p>
      </div>
      @if($entity->address->complement)
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Complement') }}: </span>
          {{ $entity->address->complement }}
        </p>
      </div>
      @endif
    </dl>
  </div>
  <div class="flex pt-4 items-center border-t border-gray-200 rounded-b dark:border-gray-600 justify-end gap-x-2">
    <x-secondary-button :href="route('supplier')" wire:navigate> {{ __('Back') }} </x-secondary-button>
    @can($permission_update)
      <x-primary-button :href="route('supplier.edit', $entity->id)" wire:navigate> {{ __('Edit') }} </x-primary-button>
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

      @can($permission_photo_delete)
        <x-danger-button wire:click="destroy" class="ms-3">
          {{ __('Delete') }}
        </x-danger-button>
      @endcan
    </x-slot:footer>
  </x-modal>

  <x-toast :$msg :$icon />
</div>
