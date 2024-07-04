<div class="space-y-2 pb-4">
  <x-form.input name="name" label="Name" type="text" placeholder="Name" :messages="$errors->get('form.name')"
    wire:model="form.name" class="w-full" />

  <x-form.input name="email" label="E-mail" type="email" placeholder="E-mail" :messages="$errors->get('form.email')"
    wire:model="form.email" class="w-full" />

  <x-form.input name="user_name" label="User Name" type="text" placeholder="User Name"
    :messages="$errors->get('form.user_name')" wire:model="form.user_name" class="w-full" />

  <x-form.input name="password" label="Password" type="password" placeholder="Password"
    :messages="$errors->get('form.password')" wire:model="form.password" class="w-full" />

  <x-form.input name="password_confirmation" label="Confirm Password" type="password" placeholder="Confirm Password"
    :messages="$errors->get('form.password_confirmation')" wire:model="form.password_confirmation" class="w-full" />
</div>
