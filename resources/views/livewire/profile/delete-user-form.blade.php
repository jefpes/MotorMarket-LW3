<section class="space-y-6">
  <header>
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
      {{ __('Delete Account') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
      {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
    </p>
  </header>

  <x-danger-button wire:click="$set('modal', true)"> {{ __('Delete Account') }}</x-danger-button>

  <x-modal wire:model='modal' name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Are you sure you want to delete your account?') }}
      </h2>

      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
      </p>

      <div class="mt-6">
        <x-form.input name="password" label="Password" type="text" placeholder="Password" :messages="$errors->get('password')"
          wire:model="password" class="w-full" />

      </div>

      <div class="mt-6 flex justify-end">
        <x-secondary-button wire:click="$set('modal', false)"> {{ __('Cancel') }} </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="deleteUser"> {{ __('Delete Account') }} </x-danger-button>
      </div>
  </x-modal>
</section>
