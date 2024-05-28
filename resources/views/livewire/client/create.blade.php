<div>
  <x-slot name="header">{{ __($header) }}</x-slot>
  <div class="space-y-2 mb-4">
    <x-form.input name="name" label="Name" type="text" placeholder="Name" :messages="$errors->get('form.name')" wire:model="form.name" class="w-full" />
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="basis-1/2">
        <x-form.input name="rg" label="RG" placeholder="RG" :messages="$errors->get('form.rg')" wire:model="form.rg" class="w-full" />
      </div>
      <div class="basis-1/2">
        <x-form.input name="cpf" label="CPF" type="text" placeholder="CPF" :messages="$errors->get('form.cpf')" wire:model="form.cpf" class="w-full" />
      </div>
    </div>
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="basis-1/2">
        <x-form.input name="phone_one" label="Phone (1)" placeholder="Phone (1)" :messages="$errors->get('form.phone_one')" wire:model="form.phone_one" class="w-full" />
      </div>
      <div class="basis-1/2">
        <x-form.input name="phone_two" label="Phone (2)" placeholder="Phone (2)" :messages="$errors->get('form.phone_two')" wire:model="form.phone_two" class="w-full" />
      </div>
    </div>
    <x-form.input name="affiliated_one" label="Affiliated (1)" placeholder="Affiliated (1)" :messages="$errors->get('form.affiliated_one')" wire:model="form.affiliated_one" class="w-full" />
    <x-form.input name="affiliated_two" label="Affiliated (2)" placeholder="Affiliated (2)" :messages="$errors->get('form.affiliated_two')" wire:model="form.affiliated_two" class="w-full" />
    <x-form.input name="affiliated_three" label="Affiliated (3)" placeholder="Affiliated (3)" :messages="$errors->get('form.affiliated_three')" wire:model="form.affiliated_three" class="w-full" />
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="basis-1/2">
        <x-form.file-input name="photo" label="Photo" placeholder="Photo" :messages="$errors->get('photos')"
          wire:model="photos" class="w-full" />
      </div>
      <div class="basis-1/2">
        <x-form.input name="birth_date" label="Birth Date" type="date" placeholder="Birth Date" :messages="$errors->get('form.birth_date')"
          wire:model="form.birth_date" class="w-full" />
      </div>
    </div>

    <div class="inline-flex items-center justify-center w-full">
      <hr class="w-full h-1 my-8 bg-gray-200 border-0 rounded dark:bg-gray-700">
      <div class="absolute px-4 -translate-x-1/2 bg-white left-1/2 dark:bg-gray-800">
        {{ __('Address') }}
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="md:basis-1/3">
        <x-form.input disabled name="country" label="Country" placeholder="Country" :messages="$errors->get('form.country')" wire:model="form.country" class="w-full" />
      </div>
      <div class="md:basis-1/3">
        <x-form.input name="cep" label="CEP" placeholder="CEP" :messages="$errors->get('form.cep')" wire:model="form.cep" class="w-full" />
      </div>
      <div class="md:basis-1/3">
        <x-select wire:model="form.state" class="w-full" label='State' id="state_select">
          <option value=""> {{ __('Select a State')}} </option>
          @foreach ($states as $data)
          <option value="{{ $data->value }}"> {{ $data->nome() }} </option>
          @endforeach
        </x-select>
      </div>
    </div>
    <x-form.input name="logradouro" label="Logradouro" placeholder="Logradouro" :messages="$errors->get('form.logradouro')" wire:model="form.logradouro" class="w-full" />
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="md:basis-1/3">
        <x-form.input name="number" label="Number" placeholder="Number" :messages="$errors->get('form.number')" wire:model="form.number" class="w-full" />
      </div>
      <div class="md:basis-1/3">
        <x-form.input name="bairro" label="Bairro" placeholder="Bairro" :messages="$errors->get('form.bairro')" wire:model="form.bairro" class="w-full" />
      </div>
      <div class="md:basis-1/3">
        <x-form.input name="city" label="City" placeholder="City" :messages="$errors->get('form.city')" wire:model="form.city" class="w-full" />
      </div>
    </div>
    <x-form.textarea name="complement" label="Complement" placeholder="Complement" :messages="$errors->get('form.complement')"
      wire:model="form.complement" class="w-full" />
  </div>

  <div class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600 justify-end">
    <x-secondary-button :href="route('client')" wire:navigate>
      {{ __('Back') }}
    </x-secondary-button>

    <x-primary-button wire:click="save" class="ms-3">
      {{ __('Save') }}
    </x-primary-button>
  </div>

  <x-toast on="show-toast" :$icon> {{ __( $msg ) }} </x-toast>
</div>
