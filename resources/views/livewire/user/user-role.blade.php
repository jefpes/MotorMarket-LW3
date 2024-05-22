<div>
  <x-slot name="header"> {{__('Roles of')}}: <span class="text-yellow-300"> {{ $user->name }} </span> </x-slot>
  <div class="flex mb-4 justify-center">
    <x-primary-button :href="route('users')" wire:navigate>{{__("Back")}}</x-primary-button>
  </div>

  <div class="flex flex-row flex-wrap pt-2">
    @foreach ($roles as $role)
    <div class="w-1/2 md:w-1/4 lg:w-1/6 ">
      <x-toggle :key="$role->id" :text="__($role->name)" wire:click="toggleRole({{ $role->id }})"
        ckd="{{ $user->roles->contains($role->id) ? true : false}}" />
    </div>
    @endforeach
  </div>
</div>
