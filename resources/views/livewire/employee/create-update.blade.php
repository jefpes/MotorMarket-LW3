<div>
  <x-slot name="header">{{ __($header) }}</x-slot>

  <div class="space-y-2">
    <x-form.input name="name" label="Name" type="text" placeholder="Name" :messages="$errors->get('employee.name')"
      wire:model="employee.name" class="w-full" />
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="basis-1/3">
        <x-form.input x-mask="999999999999999999999" name="rg" label="RG" placeholder="RG"
          :messages="$errors->get('employee.rg')" wire:model="employee.rg" class="w-full" />
      </div>
      <div class="basis-1/3">
        <x-form.cpf-input name="cpf" label="CPF" type="text" placeholder="CPF" :messages="$errors->get('employee.cpf')"
          wire:model="employee.cpf" class="w-full" />
      </div>
      <div class="basis-1/3">
        <x-form.money-input name="salary" label="Salary" type="text" placeholder="Salary"
          :messages="$errors->get('employee.salary')" wire:model="employee.salary" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-0">
        <x-select :messages="$errors->get('employee.marital_status')" wire:model="employee.marital_status" class="w-full"
          label='Marital Status' id="marital_status">
          <option value=""> {{ __('Select')}} </option>
          @foreach ($maritalStatus as $data)
          <option value="{{ $data->value }}"> {{ $data->value }} </option>
          @endforeach
        </x-select>
      </div>
      <div class="flex-1">
        <x-form.input name="spouse" label="Spouse" placeholder="Spouse" :messages="$errors->get('employee.spouse')"
          wire:model="employee.spouse" class="w-full" />
      </div>
    </div>

    <x-form.input name="email" label="Email" placeholder="Email" :messages="$errors->get('employee.email')"
      wire:model="employee.email" class="w-full" />

    <x-form.input name="father" label="Father" placeholder="Father" :messages="$errors->get('employee.father')"
      wire:model="employee.father" class="w-full" />
    <x-form.input name="mother" label="Mother" placeholder="Mother" :messages="$errors->get('employee.mother')"
      wire:model="employee.mother" class="w-full" />
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="basis-1/2">
        <x-form.phone-input name="phone_one" label="Phone (1)" placeholder="Phone (1)"
          :messages="$errors->get('employee.phone_one')" wire:model="employee.phone_one" class="w-full" />
      </div>
      <div class="basis-1/2">
        <x-form.phone-input name="phone_two" label="Phone (2)" placeholder="Phone (2)"
          :messages="$errors->get('employee.phone_two')" wire:model="employee.phone_two" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="basis-1/2">
        <x-form.file-input-single name="photo" label="Photo" placeholder="Photo"
          :messages="$errors->get('employeePhoto.photos')" wire:model="employeePhoto.photos" class="w-full" />
      </div>
      <div class="basis-1/2">
        <x-form.input name="birth_date" label="Birth Date" type="date" placeholder="Birth Date"
          :messages="$errors->get('employee.birth_date')" wire:model="employee.birth_date" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="basis-1/2">
        <x-form.input name="hiring_date" label="Hiring Date" type="date" placeholder="Hiring Date"
          :messages="$errors->get('employee.hiring_date')" wire:model="employee.hiring_date" class="w-full" />
      </div>
      <div class="basis-1/2">
        <x-form.input disabled name="resignation_date" label="Resignation Date" type="date" placeholder="Resignation Date"
          :messages="$errors->get('employee.resignation_date')" wire:model="employee.resignation_date" class="w-full" />
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
        <x-form.cep-input name="cep" label="CEP" placeholder="CEP" :messages="$errors->get('employeeAddress.zip_code')"
          wire:model="employeeAddress.zip_code" class="w-full" />
      </div>
      <div class="md:basis-1/3">
        <x-select wire:model="employeeAddress.city_id" class="w-full" label='City' id="city_select"
          :messages="$errors->get('employeeAddress.city_id')">
          <option value=""> {{ __('Select a City')}} </option>
          @foreach ($cities as $data)
          <option value="{{ $data->id }}"> {{ $data->name }} </option>
          @endforeach
        </x-select>
      </div>
      <div class="md:basis-1/3">
        <x-select wire:model="employeeAddress.state" class="w-full" label='State' id="state_select"
          :messages="$errors->get('employeeAddress.state')">
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
          :messages="$errors->get('employeeAddress.street')" wire:model="employeeAddress.street" class="w-full" />
      </div>
    </div>
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="md:basis-1/3">
        <x-form.input x-mask="99999" name="number" label="Number" placeholder="Number"
          :messages="$errors->get('employeeAddress.number')" wire:model="employeeAddress.number" class="w-full" />
      </div>
      <div class="md:basis-1/3">
        <x-form.input name="bairro" label="Bairro" placeholder="Bairro"
          :messages="$errors->get('employeeAddress.neighborhood')" wire:model="employeeAddress.neighborhood"
          class="w-full" />
      </div>
      <div class="md:basis-1/3">
        <x-form.input name="complement" label="Complement" placeholder="Complement"
          :messages="$errors->get('employeeAddress.complement')" wire:model="employeeAddress.complement" class="w-full" />
      </div>
    </div>

    <div class="flex items-center mt-4 pt-2 border-t border-gray-200 rounded-b dark:border-gray-600 justify-end">
      <x-secondary-button href="{{ route('employee') }}" wire:navigate> {{ __('Back') }} </x-secondary-button>

      <x-primary-button wire:click="save" class="ms-3"> {{ __('Save') }} </x-primary-button>
    </div>
  </div>

  <x-toast :$msg :$icon />
</div>
