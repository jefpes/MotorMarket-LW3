<div>
  <x-slot name="header">{{ __($header) }}</x-slot>

  <div class="space-y-2">
    <div class="flex flex-col md:flex-row justify-between md:space-x-2 md:space-y-0 space-y-2">
      <div class="basis-1/3">
        <x-form.input name="purchase_date" label="Purchase Date" type="date" placeholder="Purchase Date"
          :messages="$errors->get('form.purchase_date')" wire:model="form.purchase_date" class="w-full" />
      </div>
      <div class="basis-1/3">
        <x-form.input x-mask="9999" name="year_one" label="Year" placeholder="Year"
          :messages="$errors->get('form.year_one')" wire:model="form.year_one" class="w-full" />
      </div>
      <div class="basis-1/3">
        <x-form.input x-mask="9999" name="year_two" label="Year" placeholder="Year"
          :messages="$errors->get('form.year_two')" wire:model="form.year_two" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2 md:space-y-0 space-y-2">
      <div class="flex-1">
        <x-select wire:model="form.vehicle_model_id" class="w-full" label='Model' id="model_select">
          <option value=""> {{ __('Select')}} </option>
          @foreach ($this->models as $data)
          <option value="{{ $data->id }}"> {{ $data->name }} </option>
          @endforeach
        </x-select>
      </div>

      <div class="flex-1">
        <x-select :messages="$errors->get('form.fuel')" wire:model="form.fuel" class="w-full" label='Fuel' id="fuel">
          <option value=""> {{ __('Select')}} </option>
          @foreach ($fuelTypes as $data)
          <option value="{{ $data->value }}"> {{ $data->value }} </option>
          @endforeach
        </x-select>
      </div>

      <div class="flex-1">
        <x-form.input name="engine_power" label="Engine Power" placeholder="Engine Power"
          :messages="$errors->get('form.engine_power')" wire:model="form.engine_power" class="w-full" />
      </div>

      <div class="flex-1">
        <x-form.file-input name="photo" label="Photo" placeholder="Photo" :messages="$errors->get('photos')"
          wire:model="photos" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2 md:space-y-0 space-y-2">
      <div class="flex-1">
        <x-form.input x-mask="999999" name="km" label="KM" placeholder="KM" :messages="$errors->get('form.km')"
          wire:model="form.km" class="w-full" />
      </div>
      <div class="flex-1">
        <x-form.plate-input name="plate" label="Plate" placeholder="Plate" :messages="$errors->get('form.plate')"
          wire:model="form.plate" class="w-full" />
      </div>
      <div class="flex-1">
        <x-form.input name="color" label="Color" placeholder="Color" :messages="$errors->get('form.color')"
          wire:model="form.color" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="flex-1">
        <x-form.input name="chassi" label="Chassi" placeholder="Chassi" :messages="$errors->get('form.chassi')"
          wire:model="form.chassi" class="w-full" />
      </div>
      <div class="flex-1">
        <x-form.input name="renavan" label="Renavan" placeholder="Renavan" :messages="$errors->get('form.renavan')"
          wire:model="form.renavan" class="w-full" />
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:space-x-2 md:space-y-0 space-y-2">
      <div class="flex-1">
        <x-form.money-input name="purchase_price" label="Purchase Price" placeholder="Purchase Price"
          :messages="$errors->get('form.purchase_price')" wire:model="form.purchase_price" class="w-full" />
      </div>
      <div class="flex-1">
        <x-form.money-input name="sale_price" label="Sale Price" placeholder="Sale Price"
          :messages="$errors->get('form.sale_price')" wire:model="form.sale_price" class="w-full" />
      </div>
    </div>

    <x-form.textarea name="description" label="Description" placeholder="Description"
      :messages="$errors->get('form.description')" wire:model="form.description" class="w-full" />
  </div>

  <div class="flex items-center mt-4 pt-2 border-t border-gray-200 rounded-b dark:border-gray-600 justify-end">
    <x-secondary-button :href="route('vehicle')" wire:navigate>
      {{ __('Back') }}
    </x-secondary-button>

    <x-primary-button wire:click="save" class="ms-3">
      {{ __('Save') }}
    </x-primary-button>
  </div>

  <x-toast on="show-toast" :$icon> {{ __( $msg ) }} </x-toast>
</div>
