<div>
  <x-slot name="header">{{ __($header) }}: <span class="text-yellow-300">{{ $employee->name ?? 'People'}}</span></x-slot>

  <div class="flex overflow-x-auto pb-4">
    @forelse ($employee->photos as $photo)
      <img wire:click="actions({{ $photo->id }})" class="cursor-pointer w-full md:max-w-sm mx-auto max-h-[60vh]" src="../{{ $photo->path }}">
    @empty
      <p class="text-center text-2xl text-red-400" >{{ __('No photo available') }}</p>
    @endforelse
  </div>

  <div class="p-2 border-t border-gray-200 dark:border-gray-700">
    <div class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Name') }}: </span>
          {{ $employee->name }}
        </p>
      </div>

      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('RG') }}: </span>
          {{ $employee->rg }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('CPF') }}: </span>
          {{ $employee->cpf }}
        </p>
      </div>

      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Date Birth') }}: </span>
          <x-span-date :date="$employee->birth_date" />
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Marital Status') }}: </span>
          {{ $employee->marital_status }}
        </p>
      </div>
      @if($employee->spouse)
        <div class="flex">
          <p class="text-lg font-semibold">
            <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Spouse') }}: </span>
            {{ $employee->spouse }}
          </p>
        </div>
      @endif
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Mother') }}: </span>
          {{ $employee->mother }}
        </p>
      </div>
      @if($employee->father)
        <div class="flex">
          <p class="text-lg font-semibold">
            <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Father') }}: </span>
            {{ $employee->father }}
          </p>
        </div>
      @endif
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Salary') }}: </span>
          <x-span-money :money="$employee->salary" />
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Hiring Date') }}: </span>
          <x-span-date :date="$employee->hiring_date" />
        </p>
      </div>
      @if ($employee->resignation_date)
        <div class="flex">
          <p class="text-lg font-semibold">
            <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Resignation Date') }}: </span>
            <x-span-date :date="$employee->resignation_date" />
          </p>
        </div>
      @endif

      <div class="inline-flex items-center justify-center w-full">
        <hr class="w-full h-1 my-8 bg-gray-200 border-0 rounded dark:bg-gray-700">
        <div class="absolute px-4 -translate-x-1/2 bg-white left-1/2 dark:bg-gray-800">
          {{ __('Contacts') }}
        </div>
      </div>

      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Email') }}: </span>
          {{ $employee->email }}
        </p>
      </div>

      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Phone') }}
            @if($employee->phone_two)(1)@endif: </span>
          {{ $employee->phone_one }}
        </p>
      </div>
      @if($employee->phone_two)
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Phone') }} (2): </span>
          {{ $employee->phone_two }}
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
          {{ $employee->address->state ?? ''}}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('City') }}: </span>
          {{ $employee->address->city->name ?? '' }}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Bairro') }}: </span>
          {{ $employee->address->neighborhood ?? ''}}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('CEP') }}: </span>
          {{ $employee->address->zip_code ?? ''}}
        </p>
      </div>
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Logradouro') }}: </span>
          {{ $employee->address->street }}, {{ $employee->address->number }}
        </p>
      </div>
      @if($employee->address->complement)
      <div class="flex">
        <p class="text-lg font-semibold">
          <span class="text-gray-500 md:text-lg dark:text-gray-400 uppercase">{{ __('Complement') }}: </span>
          {{ $employee->address->complement }}
        </p>
      </div>
      @endif
    </div>
  </div>
  <div class="flex pt-4 items-center border-t border-gray-200 rounded-b dark:border-gray-600 justify-end gap-x-2">
    <x-secondary-button :href="route('employee')" wire:navigate> {{ __('Back') }} </x-secondary-button>
    @can($permission::EMPLOYEE_UPDATE->value)
      <x-primary-button :href="route('employee.edit', $employee->id)" wire:navigate> {{ __('Edit') }} </x-primary-button>
    @endcan
  </div>

  <x-modal wire:model="modal" name="modal">
    <x-slot:title> {{ __('Options') }} </x-slot:title>
    <div class="w-full">
      <p> {{__('Select action wished.')}} </p>
    </div>

    <x-slot:footer>
      <x-secondary-button wire:click="cancel"> {{ __('Back') }} </x-secondary-button>

      <x-primary-button wire:click="download" class="ms-3"> {{ __('Download') }} </x-primary-button>

      @can($permission::EMPLOYEE_PHOTO_DELETE->value)
        <x-danger-button wire:click="destroy" class="ms-3"> {{ __('Delete') }} </x-danger-button>
      @endcan
    </x-slot:footer>
  </x-modal>

  <x-toast on="show-toast" :$icon>
    {{ __( $msg ) }}
  </x-toast>
</div>
