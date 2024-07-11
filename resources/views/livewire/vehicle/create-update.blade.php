<div>
  <x-slot name="header">{{ __($header) }}</x-slot>

  <div class="space-y-2">
    <div class="flex flex-col md:flex-row justify-between md:space-x-2 md:space-y-0 space-y-2">
      <div class="basis-1/3">
        <x-form.input name="purchase_date" label="Purchase Date" type="date" placeholder="Purchase Date"
          :messages="$errors->get('vehicle.purchase_date')" wire:model="vehicle.purchase_date" class="w-full" />
      </div>
      <div class="basis-1/3">
        <x-form.input x-mask="9999" name="year_one" label="Year" placeholder="Year"
          :messages="$errors->get('vehicle.year_one')" wire:model="vehicle.year_one" class="w-full" />
      </div>
      <div class="basis-1/3">
        <x-form.input x-mask="9999" name="year_two" label="Year" placeholder="Year"
          :messages="$errors->get('vehicle.year_two')" wire:model="vehicle.year_two" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2 md:space-y-0 space-y-2">
      <div class="flex-1">
        <x-select wire:model="vehicle.vehicle_model_id" class="w-full" label='Model' id="model_select">
          <option value=""> {{ __('Select')}} </option>
          @foreach ($this->models as $data)
          <option value="{{ $data->id }}"> {{ $data->name }} </option>
          @endforeach
        </x-select>
      </div>

      <div class="flex-1">
        <x-select :messages="$errors->get('vehicle.fuel')" wire:model="vehicle.fuel" class="w-full" label='Fuel' id="fuel">
          <option value=""> {{ __('Select')}} </option>
          @foreach ($fuelTypes as $data)
          <option value="{{ $data->value }}"> {{ $data->value }} </option>
          @endforeach
        </x-select>
      </div>

      <div class="flex-1">
        <x-form.input name="engine_power" label="Engine Power" placeholder="Engine Power"
          :messages="$errors->get('vehicle.engine_power')" wire:model="vehicle.engine_power" class="w-full" />
      </div>

      <div class="flex-1">
        <x-form.file-input name="photos" label="Photos" placeholder="Photos"
          :messages="$errors->get('vehiclePhoto.photos')" wire:model="vehiclePhoto.photos" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2 md:space-y-0 space-y-2">
      <div class="flex-1">
        <x-form.input x-mask="999999" name="km" label="KM" placeholder="KM" :messages="$errors->get('vehicle.km')"
          wire:model="vehicle.km" class="w-full" />
      </div>
      <div class="flex-1">
        <x-form.plate-input name="plate" label="Plate" placeholder="Plate" :messages="$errors->get('vehicle.plate')"
          wire:model="vehicle.plate" class="w-full" />
      </div>
      <div class="flex-1">
        <x-form.input name="color" label="Color" placeholder="Color" :messages="$errors->get('vehicle.color')"
          wire:model="vehicle.color" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-1">
        <x-form.input name="chassi" label="Chassi" placeholder="Chassi" :messages="$errors->get('vehicle.chassi')"
          wire:model="vehicle.chassi" class="w-full" />
      </div>
      <div class="flex-1">
        <x-form.input name="renavan" label="Renavan" placeholder="Renavan" :messages="$errors->get('vehicle.renavan')"
          wire:model="vehicle.renavan" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2 md:space-y-0 space-y-2">
      <div class="flex-1">
        <x-form.money-input name="purchase_price" label="Purchase Price" placeholder="Purchase Price"
          :messages="$errors->get('vehicle.purchase_price')" wire:model="vehicle.purchase_price" class="w-full" />
      </div>
      <div class="flex-1">
        <x-form.money-input name="sale_price" label="Sale Price" placeholder="Sale Price"
          :messages="$errors->get('vehicle.sale_price')" wire:model="vehicle.sale_price" class="w-full" />
      </div>
    </div>

    <x-form.textarea name="description" label="Description" placeholder="Description"
      :messages="$errors->get('vehicle.description')" wire:model="vehicle.description" class="w-full" />
  </div>

  <div class="flex items-center mt-4 pt-2 border-t border-gray-200 rounded-b dark:border-gray-600 justify-end">
    <x-secondary-button :href="route('vehicle')" wire:navigate>
      {{ __('Back') }}
    </x-secondary-button>

    <x-primary-button wire:click="save" class="ms-3">
      {{ __('Save') }}
    </x-primary-button>
  </div>

  <x-toast :$msg :$icon />
</div>