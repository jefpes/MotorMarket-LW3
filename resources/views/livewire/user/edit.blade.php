<div>
  <x-modal wire:model="modal" name="group_modal">
    <x-slot:title> {{ __($title) }}: <span class="text-yellow-300">{{ $form->name ?? '' }}</span> </x-slot:title>

    <x-select name="employee_id" label="Employee" :messages="$errors->get('form.employee_id')" wire:model="form.employee_id"
      class="w-full">
      <option value="">{{ __('Select') }}</option>
      @foreach ($employees as $employee)
      <option value="{{ $employee->id }}">{{ $employee->name }}</option>
      @endforeach
    </x-select>

    <x-slot:footer>
      <x-secondary-button type="button" wire:click="cancel">
        {{ __('Cancel') }}
      </x-secondary-button>

      <x-primary-button wire:click="save" class="ms-3">
        {{ __('Update') }}
      </x-primary-button>

    </x-slot:footer>
  </x-modal>

  <x-toast on="show-toast" :$icon>
    {{ __( $msg ) }}
  </x-toast>
</div>
