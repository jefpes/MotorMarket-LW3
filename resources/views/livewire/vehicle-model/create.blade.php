<div>
  <x-primary-button type='button' wire:click="$set('modal', true)" class="text-[1em] tracking-normal"> {{ __('New') }} </x-primary-button>

  <x-modal wire:model="modal" name="amodal">
    <x-slot:title> {{ __('Create New Vehicle Model') }} </x-slot:title>

    <x-form.input name="name" label="Name" type="text" placeholder="Name" :messages="$errors->get('form.name')"
      wire:model="form.name" class="w-full" />

    <div class="flex gap-2">
      <div class="mt-4 flex-1">
        <x-input-label>{{__('Brand')}}</x-input-label>
        <x-select wire:model="form.brand_id" class="w-full">
          <option value=""> {{ __('Select a Brand') }} </option>
          @foreach ($this->brands as $brand)
          <option value="{{ $brand->id }}"> {{ $brand->name }} </option>
          @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('form.brand_id')" />
      </div>

      <div class="mt-4 flex-1">
        <x-input-label>{{__('Type')}}</x-input-label>
        <x-select wire:model="form.vehicle_type_id" class="w-full">
          <option value=""> {{ __('Select a Type') }} </option>
          @foreach ($this->types as $data)
          <option value="{{ $data->id }}"> {{ $data->name }} </option>
          @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('form.vehicle_type_id')" />
      </div>
    </div>

    <x-slot:footer>
      <x-secondary-button wire:click="cancel">
        {{ __('Cancel') }}
      </x-secondary-button>

      <x-primary-button wire:click="save" class="ms-3">
        {{ __('Save') }}
      </x-primary-button>
    </x-slot:footer>
  </x-modal>

  <x-toast on="show-toast" :$icon>
    {{ __( $msg ) }}
  </x-toast>
</div>
