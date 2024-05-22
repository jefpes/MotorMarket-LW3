<div>
  <x-primary-button type='button' wire:click="$set('modal', true)" class="text-[1em] tracking-normal"> {{ __('New Role') }} </x-primary-button>

  <x-modal wire:model="modal" name="amodal">
    <x-slot:title> {{ __('Create New Role') }} </x-slot:title>
    <x-form.input name="name" label="Name" type="text" placeholder="Name" :messages="$errors->get('form.name')"
      wire:model="form.name" class="w-full" />

    <div class="mt-4">
      <x-input-label>{{__('hierarchy')}}</x-input-label>
      <x-select wire:model="form.hierarchy">
        <option value=""> {{ __('Select a hierarchy level') }} </option>
        @for ($i = auth()->user()->roles()->pluck('hierarchy')->max(); $i < 100; $i++)
        <option value="{{ $i }}"> {{ $i }} </option>
          @endfor
      </x-select>
      <x-input-error :messages="$errors->get('form.hierarchy')" />
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
