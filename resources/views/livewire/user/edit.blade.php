<div>
  <x-slot name="header"> {{__('Edit user')}}: {{ $form->name }} </x-slot>

  <div class="space-y-4 pb-4">
    <x-form.input name="name" label="Name" type="text" placeholder="Name" :messages="$errors->get('form.name')"
      wire:model="form.name" class="w-full" />

    <x-form.input name="email" label="E-mail" type="email" placeholder="E-mail"
      :messages="$errors->get('form.email')" wire:model="form.email" class="w-full" />

    <x-form.input name="user_name" label="User Name" type="text" placeholder="User Name"
      :messages="$errors->get('form.user_name')" wire:model="form.user_name" class="w-full" />

    <x-form.input name="regist_number" label="Register Number" type="text" placeholder="Register Number"
      :messages="$errors->get('form.regist_number')" wire:model="form.regist_number" class="w-full" />
  </div>

  <div class="flex justify-end border-t pt-4">

    <x-secondary-button href="{{ route('users') }}" wire:navigate> {{ __('Back') }} </x-secondary-button>
    <x-primary-button wire:click="save" class="ms-3"> {{ __('Save') }} </x-primary-button>

  </div>
</div>
