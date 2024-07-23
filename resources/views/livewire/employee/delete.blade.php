<div>
  <x-modal wire:model="modal" name="main_modal">
    <x-slot:title>
      {{ __($title) }}: <span class="text-yellow-300">{{ $form->name }}</span>
    </x-slot:title>

    <x-slot:footer>
      <x-secondary-button wire:click="cancel">
        {{ __('Cancel') }}
      </x-secondary-button>

      @can($permission::EMPLOYEE_DELETE->value)
        @if ($form->resignation_date)
          <x-primary-button wire:click="dismissRetain(false)" class="ms-3">
            {{ __('Retain') }}
          </x-primary-button>
        @else
          <x-danger-button wire:click="dismissRetain(true)" class="ms-3">
            {{ __('Dismiss') }}
          </x-danger-button>
        @endif

      @endcan
    </x-slot:footer>
  </x-modal>

  <x-toast :$msg :$icon />
</div>
