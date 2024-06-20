<div>
  <x-form.input name="date" label="Date" type="date" :messages="$errors->get('form.date')" wire:model="form.date"
    class="w-full" />

  <x-form.input x-mask="9999999" name="value" label="Value" placeholder="Value" :messages="$errors->get('form.value')"
    wire:model="form.value" class="w-full" />

  <x-form.textarea name="description" label="Description" placeholder="Description"
    :messages="$errors->get('form.description')" wire:model="form.description" class="w-full" />
</div>
