<div>
  <x-slot name="header">{{ __($header) }}</x-slot>

  <div class="space-y-2">
    <x-form.input name="name" label="Name" type="text" placeholder="Name" :messages="$errors->get('entityForm.name')"
      wire:model="entityForm.name" class="w-full" />
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-1">
        <x-form.input x-mask="999999999999999999999" name="rg" label="RG" placeholder="RG"
          :messages="$errors->get('entityForm.rg')" wire:model="entityForm.rg" class="w-full" />
      </div>
      <div class="flex-1">
        <x-form.cpf-input name="cpf" label="CPF" type="text" placeholder="CPF"
          :messages="$errors->get('entityForm.cpf')" wire:model="entityForm.cpf" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-0">
        <x-select :messages="$errors->get('entityForm.gender')" wire:model="entityForm.gender" class="w-full"
          label='Gender' id="gender">
          <option value=""> {{ __('Select')}} </option>
          @foreach ($genders as $data)
          <option value="{{ $data->value }}"> {{ $data->value }} </option>
          @endforeach
        </x-select>
      </div>
      <div class="flex-0">
        <x-select :messages="$errors->get('entityForm.marital_status')" wire:model="entityForm.marital_status" class="w-full"
          label='Marital Status' id="marital_status">
          <option value=""> {{ __('Select')}} </option>
          @foreach ($maritalStatus as $data)
          <option value="{{ $data->value }}"> {{ $data->value }} </option>
          @endforeach
        </x-select>
      </div>
      <div class="flex-1">
        <x-form.input name="spouse" label="Spouse" placeholder="Spouse" :messages="$errors->get('entityForm.spouse')"
          wire:model="entityForm.spouse" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="basis-1/2">
        <x-form.input x-mask="(99) 99999-9999" name="phone_one" label="Phone (1)" placeholder="Phone (1)"
          :messages="$errors->get('entityForm.phone_one')" wire:model="entityForm.phone_one" class="w-full" />
      </div>
      <div class="basis-1/2">
        <x-form.input x-mask="(99) 99999-9999" name="phone_two" label="Phone (2)" placeholder="Phone (2)"
          :messages="$errors->get('entityForm.phone_two')" wire:model="entityForm.phone_two" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-1">
        <x-form.input name="father" label="Father" placeholder="Father" :messages="$errors->get('entityForm.father')"
          wire:model="entityForm.father" class="w-full" />
      </div>
      <div class="flex-0">
        <x-form.phone-input name="father_phone" label="Father Phone" placeholder="Phone"
          :messages="$errors->get('entityForm.father_phone')" wire:model="entityForm.father_phone" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-1">
        <x-form.input name="mother" label="Mother" placeholder="Mother" :messages="$errors->get('entityForm.mother')"
          wire:model="entityForm.mother" class="w-full" />
      </div>
      <div class="flex-0">
        <x-form.phone-input name="mother_phone" label="Mother Phone" placeholder="Phone"
          :messages="$errors->get('entityForm.mother_phone')" wire:model="entityForm.mother_phone" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-1">
        <x-form.input name="affiliated_one" label="Affiliated (1)" placeholder="Affiliated (1)"
          :messages="$errors->get('entityForm.affiliated_one')" wire:model="entityForm.affiliated_one" class="w-full" />
      </div>
      <div class="flex-0">
        <x-form.phone-input name="affiliated_one_phone" label="Affiliated Phone (1)" placeholder="Phone"
          :messages="$errors->get('entityForm.affiliated_one_phone')" wire:model="entityForm.affiliated_one_phone" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-1">
        <x-form.input name="affiliated_two" label="Affiliated (2)" placeholder="Affiliated (2)"
          :messages="$errors->get('entityForm.affiliated_one')" wire:model="entityForm.affiliated_two" class="w-full" />
      </div>
      <div class="flex-0">
        <x-form.phone-input name="affiliated_two_phone" label="Affiliated Phone (2)" placeholder="Phone"
          :messages="$errors->get('entityForm.affiliated_two_phone')" wire:model="entityForm.affiliated_two_phone" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="basis-1/2">
        <x-form.file-input name="photo" label="Photo" placeholder="Photo" wire:model="entityPhotoForm.photos" class="w-full" />
      </div>
      <div class="basis-1/2">
        <x-form.date-input name="birth_date" label="Birth Date" :messages="$errors->get('entityForm.birth_date')" wire:model="entityForm.birth_date" class="w-full" />
      </div>
    </div>
    <x-form.textarea name="description" label="Description" placeholder="Description"
      :messages="$errors->get('entityForm.description')" wire:model="entityForm.description" class="w-full" />

    <div class="inline-flex items-center justify-center w-full">
      <hr class="w-full h-1 my-8 bg-gray-200 border-0 rounded dark:bg-gray-700">
      <div class="absolute px-4 -translate-x-1/2 bg-white left-1/2 dark:bg-gray-800">
        {{ __('Address') }}
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="md:basis-1/3">
        <x-form.cep-input name="cep" label="CEP" placeholder="CEP" :messages="$errors->get('entityAddressForm.zip_code')"
          wire:model="entityAddressForm.zip_code" class="w-full" />
      </div>
      <div class="md:basis-1/3">
        <x-select wire:model="entityAddressForm.city_id" class="w-full" label='City' id="city_select"
          :messages="$errors->get('entityAddressForm.city_id')">
          <option value=""> {{ __('Select a City')}} </option>
          @foreach ($cities as $data)
          <option value="{{ $data->id }}"> {{ $data->name }} </option>
          @endforeach
        </x-select>
      </div>
      <div class="md:basis-1/3">
        <x-select wire:model="entityAddressForm.state" class="w-full" label='State' id="state_select"
          :messages="$errors->get('entityAddressForm.state')">
          <option value=""> {{ __('Select a State')}} </option>
          @foreach ($states as $data)
          <option value="{{ $data->value }}"> {{ $data->value }} </option>
          @endforeach
        </x-select>
      </div>
    </div>
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="md:flex-1">
        <x-form.input name="logradouro" label="Logradouro" placeholder="Logradouro"
          :messages="$errors->get('entityAddressForm.street')" wire:model="entityAddressForm.street" class="w-full" />
      </div>
    </div>
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="md:basis-1/3">
        <x-form.input name="number" label="Number" placeholder="Number"
          :messages="$errors->get('entityAddressForm.number')" wire:model="entityAddressForm.number" class="w-full" />
      </div>
      <div class="md:basis-1/3">
        <x-form.input name="bairro" label="Bairro" placeholder="Bairro"
          :messages="$errors->get('entityAddressForm.neighborhood')" wire:model="entityAddressForm.neighborhood"
          class="w-full" />
      </div>
      <div class="md:basis-1/3">
        <x-form.input name="complement" label="Complement" placeholder="Complement"
          :messages="$errors->get('entityAddressForm.complement')" wire:model="entityAddressForm.complement" class="w-full" />
      </div>
    </div>

  <div class="flex items-center mt-4 pt-2 border-t border-gray-200 rounded-b dark:border-gray-600 justify-end">
    <x-secondary-button :href="route('supplier')" wire:navigate>
      {{ __('Back') }}
    </x-secondary-button>

    <x-primary-button wire:click="save" class="ms-3">
      {{ __('Save') }}
    </x-primary-button>
  </div>

  <x-toast :$msg :$icon />
</div>
