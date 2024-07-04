<div class="space-y-2 pb-4">
  <x-select name="employee_id" label="Employee" :messages="$errors->get('form.employee_id')"
    wire:model="form.employee_id" class="w-full" >
    <option value="">{{ __('Select') }}</option>
    @foreach ($employees as $employee)
      <option value="{{ $employee->id }}">{{ $employee->name }}</option>
    @endforeach
  </x-select>

  <x-form.input name="password" label="Password" type="password" placeholder="Password"
    :messages="$errors->get('form.password')" wire:model="form.password" class="w-full" />

  <x-form.input name="password_confirmation" label="Confirm Password" type="password" placeholder="Confirm Password"
    :messages="$errors->get('form.password_confirmation')" wire:model="form.password_confirmation" class="w-full" />
</div>
