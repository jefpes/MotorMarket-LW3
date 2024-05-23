<div>
  <x-primary-button type='button' wire:click="$set('modal', true)" class="text-[1em] tracking-normal"> {{ __('New') }} </x-primary-button>

  <x-modal wire:model="modal" name="amodal">
    <x-slot:title> {{ __('Create New Vehicle Model') }} </x-slot:title>
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
