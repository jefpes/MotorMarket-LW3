<div>
  <x-slot name="header">{{ __($header) }}</x-slot>

  <div class="space-y-2">
    <x-form.input name="name" label="Name" type="text" placeholder="Name" :messages="$errors->get('client.name')"
      wire:model="client.name" class="w-full" />
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-1">
        <x-form.input x-mask="999999999999999999999" name="rg" label="RG" placeholder="RG"
          :messages="$errors->get('client.rg')" wire:model="client.rg" class="w-full" />
      </div>
      <div class="flex-1">
        <x-form.input x-mask="999.999.999-99" name="cpf" label="CPF" type="text" placeholder="CPF"
          :messages="$errors->get('client.cpf')" wire:model="client.cpf" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-0">
        <x-select :messages="$errors->get('client.gender')" wire:model="client.gender" class="w-full"
          label='Gender' id="gender">
          <option value=""> {{ __('Select')}} </option>
          @foreach ($genders as $data)
          <option value="{{ $data->value }}"> {{ $data->value }} </option>
          @endforeach
        </x-select>
      </div>
      <div class="flex-0">
        <x-select :messages="$errors->get('client.marital_status')" wire:model="client.marital_status" class="w-full"
          label='Marital Status' id="marital_status">
          <option value=""> {{ __('Select')}} </option>
          @foreach ($maritalStatus as $data)
          <option value="{{ $data->value }}"> {{ $data->value }} </option>
          @endforeach
        </x-select>
      </div>
      <div class="flex-1">
        <x-form.input name="spouse" label="Spouse" placeholder="Spouse" :messages="$errors->get('client.spouse')"
          wire:model="client.spouse" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="basis-1/2">
        <x-form.input x-mask="(99) 99999-9999" name="phone_one" label="Phone (1)" placeholder="Phone (1)"
          :messages="$errors->get('client.phone_one')" wire:model="client.phone_one" class="w-full" />
      </div>
      <div class="basis-1/2">
        <x-form.input x-mask="(99) 99999-9999" name="phone_two" label="Phone (2)" placeholder="Phone (2)"
          :messages="$errors->get('client.phone_two')" wire:model="client.phone_two" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-1">
        <x-form.input name="father" label="Father" placeholder="Father" :messages="$errors->get('client.father')"
          wire:model="client.father" class="w-full" />
      </div>
      <div class="flex-0">
        <x-form.phone-input name="father_phone" label="Father Phone" placeholder="Phone"
          :messages="$errors->get('client.father_phone')" wire:model="client.father_phone" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-1">
        <x-form.input name="mother" label="Mother" placeholder="Mother" :messages="$errors->get('client.mother')"
          wire:model="client.mother" class="w-full" />
      </div>
      <div class="flex-0">
        <x-form.phone-input name="mother_phone" label="Mother Phone" placeholder="Phone"
          :messages="$errors->get('client.mother_phone')" wire:model="client.mother_phone" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-1">
        <x-form.input name="affiliated_one" label="Affiliated (1)" placeholder="Affiliated (1)"
          :messages="$errors->get('client.affiliated_one')" wire:model="client.affiliated_one" class="w-full" />
      </div>
      <div class="flex-0">
        <x-form.phone-input name="affiliated_one_phone" label="Affiliated Phone (1)" placeholder="Phone"
          :messages="$errors->get('client.affiliated_one_phone')" wire:model="client.affiliated_one_phone" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-1">
        <x-form.input name="affiliated_two" label="Affiliated (2)" placeholder="Affiliated (2)"
          :messages="$errors->get('client.affiliated_one')" wire:model="client.affiliated_two" class="w-full" />
      </div>
      <div class="flex-0">
        <x-form.phone-input name="affiliated_two_phone" label="Affiliated Phone (2)" placeholder="Phone"
          :messages="$errors->get('client.affiliated_two_phone')" wire:model="client.affiliated_two_phone" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="basis-1/2">
        <x-form.file-input name="photo" label="Photo" placeholder="Photo" :messages="$errors->get('clientPhoto.photos')"
          wire:model="clientPhoto.photos" class="w-full" />
      </div>
      <div class="basis-1/2">
        <x-form.input name="birth_date" label="Birth Date" type="date" placeholder="Birth Date"
          :messages="$errors->get('client.birth_date')" wire:model="client.birth_date" class="w-full" />
      </div>
    </div>
    <x-form.textarea name="description" label="Description" placeholder="Description"
      :messages="$errors->get('client.description')" wire:model="client.description" class="w-full" />

    <div class="inline-flex items-center justify-center w-full">
      <hr class="w-full h-1 my-8 bg-gray-200 border-0 rounded dark:bg-gray-700">
      <div class="absolute px-4 -translate-x-1/2 bg-white left-1/2 dark:bg-gray-800">
        {{ __('Address') }}
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="md:basis-1/3">
        <x-form.cep-input name="cep" label="CEP" placeholder="CEP" :messages="$errors->get('clientAddress.zip_code')"
          wire:model="clientAddress.zip_code" class="w-full" />
      </div>
      <div class="md:basis-1/3">
        <x-select wire:model="clientAddress.city_id" class="w-full" label='City' id="city_select"
          :messages="$errors->get('clientAddress.city_id')">
          <option value=""> {{ __('Select a City')}} </option>
          @foreach ($cities as $data)
          <option value="{{ $data->id }}"> {{ $data->name }} </option>
          @endforeach
        </x-select>
      </div>
      <div class="md:basis-1/3">
        <x-select wire:model="clientAddress.state" class="w-full" label='State' id="state_select"
          :messages="$errors->get('clientAddress.state')">
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
          :messages="$errors->get('clientAddress.street')" wire:model="clientAddress.street" class="w-full" />
      </div>
    </div>
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="md:basis-1/3">
        <x-form.input x-mask="99999" name="number" label="Number" placeholder="Number"
          :messages="$errors->get('clientAddress.number')" wire:model="clientAddress.number" class="w-full" />
      </div>
      <div class="md:basis-1/3">
        <x-form.input name="bairro" label="Bairro" placeholder="Bairro"
          :messages="$errors->get('clientAddress.neighborhood')" wire:model="clientAddress.neighborhood"
          class="w-full" />
      </div>
      <div class="md:basis-1/3">
        <x-form.input name="complement" label="Complement" placeholder="Complement"
          :messages="$errors->get('clientAddress.complement')" wire:model="clientAddress.complement" class="w-full" />
      </div>
    </div>

  <div class="flex items-center mt-4 pt-2 border-t border-gray-200 rounded-b dark:border-gray-600 justify-end">
    <x-secondary-button :href="route('client')" wire:navigate>
      {{ __('Back') }}
    </x-secondary-button>

    <x-primary-button wire:click="save" class="ms-3">
      {{ __('Save') }}
    </x-primary-button>
  </div>

  <x-toast :$msg :$icon />
</div>
