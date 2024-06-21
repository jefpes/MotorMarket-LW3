<div>
  <x-slot name="header"> {{ __($header) }} </x-slot>
  <div class="pb-2 space-y-2">
    <x-form.input name="name" label="Name" placeholder="Name" :messages="$errors->get('name')" wire:model="name" class="w-full" />

    <x-form.input x-mask="99.999.999/9999-99" name="cnpj" label="CNPJ" placeholder="CNPJ" :messages="$errors->get('cnpj')" wire:model="cnpj" class="w-full" />

    <x-form.textarea name="address" label="Address" placeholder="Address" :messages="$errors->get('address')" wire:model="address" class="w-full" />

    <x-form.textarea name="about" label="About" placeholder="About" :messages="$errors->get('about')" wire:model="about" class="w-full" />

    <x-form.input x-mask="(99) 9 9999 9999" name="phone" label="Phone" placeholder="Phone" :messages="$errors->get('phone')" wire:model="phone" class="w-full" />

    <x-form.input name="email" label="Email" placeholder="Email" :messages="$errors->get('email')" wire:model="email" class="w-full" />

    {{-- <x-form.input type="file" name="logo" label="Logo" :messages="$errors->get('logo')" wire:model="photos" class="w-full" /> --}}

    <x-form.input name="x" label="X" placeholder="X" :messages="$errors->get('x')" wire:model="x" class="w-full" />

    <x-form.input name="instagram" label="Instagram" placeholder="Instagram" :messages="$errors->get('instagram')" wire:model="instagram" class="w-full" />

    <x-form.input name="facebook" label="Facebook" placeholder="Facebook" :messages="$errors->get('facebook')" wire:model="facebook" class="w-full" />

    <x-form.input name="linkedin" label="Linkedin" placeholder="Linkedin" :messages="$errors->get('linkedin')" wire:model="linkedin" class="w-full" />

    <x-form.input name="youtube" label="Youtube" placeholder="Youtube" :messages="$errors->get('youtube')" wire:model="youtube" class="w-full" />

    <x-form.input name="whatsapp" label="Whatsapp" placeholder="Whatsapp" :messages="$errors->get('whatsapp')" wire:model="whatsapp" class="w-full" />
  </div>
  <div class="flex items-center py-2 border-t border-gray-200 rounded-b dark:border-gray-600 justify-end">
    <x-primary-button wire:click="save" class="ms-3"> {{ __('Save') }} </x-primary-button>
  </div>

  <x-toast on="show-toast" :$icon> {{ __( $msg ) }} </x-toast>

</div>
