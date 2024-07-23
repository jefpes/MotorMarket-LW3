<div>
  <x-primary-button type='button' wire:click="$set('modal', true)"> {{ __('New Expense') }} </x-primary-button>

  <x-modal wire:model="modal" name="expense_create_modal">
    <x-slot:title> {{ __($title) }} </x-slot:title>

    <x-form.date-input name="date" label="Date" :messages="$errors->get('form.date')" wire:model="form.date"
      class="w-full" />

    <x-form.money-input name="value" label="Value" placeholder="Value" :messages="$errors->get('form.value')"
      wire:model="form.value" class="w-full" />

    <x-form.textarea rows="2" name="description" label="Description" placeholder="Description"
      :messages="$errors->get('form.description')" wire:model="form.description" class="w-full" />

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
