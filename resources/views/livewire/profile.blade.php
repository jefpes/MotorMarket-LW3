<div>
    <x-slot name="header"> {{ __('Profile') }} </x-slot>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-700 shadow sm:rounded-lg">
          <livewire:profile.update-profile-information-form />
        </div>

      <div class="p-4 sm:p-8 bg-white dark:bg-gray-700 shadow sm:rounded-lg">
        <livewire:profile.update-password-form />
      </div>

      <div class="p-4 sm:p-8 bg-white dark:bg-gray-700 shadow sm:rounded-lg">
        <livewire:profile.delete-user-form />
      </div>
    </div>
  </div>
</div>
