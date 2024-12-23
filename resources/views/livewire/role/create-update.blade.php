<div>
  <x-modal wire:model="modal" name="amodal">
    <x-slot:title> {{ __($title) }}
      @if ($form->name)
          : <span class="text-yellow-300">{{ $form->name }}</span>
      @endif
    </x-slot:title>
    <x-form.input name="name" label="Name" type="text" placeholder="Name" :messages="$errors->get('form.name')"
      wire:model="form.name" class="w-full" />

    <div class="mt-4">
      <x-input-label>{{__('hierarchy')}}</x-input-label>
      <x-select wire:model="form.hierarchy" :messages="$errors->get('form.hierarchy')">
        <option value=""> {{ __('Select a hierarchy level') }} </option>
        @for ($i = auth()->user()->roles()->pluck('hierarchy')->max(); $i < 20; $i++)
        <option value="{{ $i }}"> {{ $i }} </option>
          @endfor
      </x-select>
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

  <x-toast :$msg :$icon />
</div>
