<div>
  <x-primary-button type='button' wire:click="$set('modal', true)" class="text-[1em] tracking-normal">{{ __('New') }}
  </x-primary-button>
  <x-modal wire:model="modal" name="main_modal">
    <x-slot:title> {{ __($title) }} </x-slot:title>

    <x-select name="employee_id" label="Employee" :messages="$errors->get('form.employee_id')" wire:model="form.employee_id"
      class="w-full">
      <option value="">{{ __('Select') }}</option>
      @foreach ($employees as $employee)
      <option value="{{ $employee->id }}">{{ $employee->name }}</option>
      @endforeach
    </x-select>

    <x-form.input name="password" label="Password" type="password" placeholder="Password"
      :messages="$errors->get('form.password')" wire:model="form.password" class="w-full" />

    <x-form.input name="password_confirmation" label="Confirm Password" type="password" placeholder="Confirm Password"
      :messages="$errors->get('form.password_confirmation')" wire:model="form.password_confirmation" class="w-full" />

    <x-slot:footer>
      <x-secondary-button type="button" wire:click="cancel">
        {{ __('Cancel') }}
      </x-secondary-button>

      <x-primary-button wire:click="save" class="ms-3">
        {{ __('Save') }}
      </x-primary-button>
    </x-slot:footer>
  </x-modal>

  <x-toast :$msg :$icon />
</div>
