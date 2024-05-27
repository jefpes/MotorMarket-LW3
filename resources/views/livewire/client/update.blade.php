<div>
  <x-slot name="header">{{ __('Editing People') }}: <span class="text-yellow-300">{{ $form->name }}</span></x-slot>
  <div class="space-y-2">
    <x-form.input name="name" label="Name" type="text" placeholder="Name" :messages="$errors->get('form.name')"
      wire:model="form.name" class="w-full" />
    <x-form.input name="surname" label="Surname" type="text" placeholder="Surname"
      :messages="$errors->get('form.surname')" wire:model="form.surname" class="w-full" />
    <x-form.input name="name_mother" label="Name Mother" type="text" placeholder="Name Mother"
      :messages="$errors->get('form.name_mother')" wire:model="form.name_mother" class="w-full" />
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="basis-1/2">
        <x-form.file-input name="photo" label="Photo" placeholder="Photo" :messages="$errors->get('form.photo')"
          wire:model="photos" class="w-full" />
      </div>
      <div class="basis-1/2">
        <x-form.input name="date_birth" label="Date Birth" type="date" placeholder="Date Birth"
          :messages="$errors->get('form.date_birth')" wire:model="form.date_birth" class="w-full" />
      </div>
    </div>
    <div class="flex flex-col md:flex-row justify-between md:space-x-2">
      <div class="md:basis-1/2">
        <x-select wire:model="form.group_id" class="w-full" label='Group' id="group_select">
          <option value=""> {{ __('Select a Group')}} </option>
          @foreach ($this->groups as $data)
          <option value="{{ $data->id }}"> {{ $data->name }} </option>
          @endforeach
        </x-select>
      </div>
      <div class="md:basis-1/2">
        <x-select wire:model="form.city_id" class="w-full" label='City' id="city_select">
          <option value=""> {{ __('Select a City')}} </option>
          @foreach ($this->cities as $data)
          <option value="{{ $data->id }}"> {{ $data->name }} </option>
          @endforeach
        </x-select>
      </div>
    </div>
    <x-form.textarea name="address" label="Address" placeholder="Address" :messages="$errors->get('form.address')"
      wire:model="form.address" class="w-full" />

    <x-form.textarea name="description" label="Description" placeholder="Description"
      :messages="$errors->get('form.description')" wire:model="form.description" class="w-full" />
  </div>

  <div class="flex items-center mt-4 pt-2 border-t border-gray-200 rounded-b dark:border-gray-600 justify-end">
    <x-secondary-button href="{{ route('people') }}" wire:navigate> {{ __('Back') }} </x-secondary-button>

    <x-primary-button wire:click="save" class="ms-3"> {{ __('Save') }} </x-primary-button>
  </div>

  <x-toast on="show-toast" :$icon> {{ __( $msg ) }} </x-toast>
</div>
