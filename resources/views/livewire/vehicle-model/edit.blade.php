<div>
  <x-modal wire:model="modal" name="edit_role_modal_{{ $form->id }}">
    <x-slot:title> {{ __('Edit Vehicle Model') }}: <span class="text-yellow-300">{{ $form->name }}</span> </x-slot:title>

    <x-form.input name="name" label="Name" type="text" placeholder="Name" :messages="$errors->get('form.name')"
      wire:model="form.name" class="w-full" />

    <div class="mt-4">
      <x-input-label>{{__('Brand')}}</x-input-label>
      <x-select wire:model="form.brand_id">
        <option value=""> {{ __('Select a Brand') }} </option>
        @foreach ($brands as $brand)
        <option value="{{ $brand->id }}"> {{ $brand->name }} </option>
        @endforeach
      </x-select>
      <x-input-error :messages="$errors->get('form.brand_id')" />
    </div>

    <div class="mt-4">
      <x-input-label>{{__('Type')}}</x-input-label>
      <x-select wire:model="form.vehicle_type_id">
        <option value=""> {{ __('Select a Type') }} </option>
        @foreach ($types as $data)
        <option value="{{ $data->id }}"> {{ $data->name }} </option>
        @endforeach
      </x-select>
      <x-input-error :messages="$errors->get('form.vehicle_type_id')" />
    </div>

    <x-slot:footer>
      <x-secondary-button wire:click="$set('modal', false)"> {{ __('Cancel') }} </x-secondary-button>

      <x-primary-button wire:click="save" class="ms-3"> {{ __('Update') }} </x-primary-button>
    </x-slot:footer>
  </x-modal>

  <x-toast on="show-toast" :$icon>
    {{ __( $msg ) }}
  </x-toast>
</div>
