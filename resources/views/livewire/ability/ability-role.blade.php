<div>
  <x-slot name="header"> {{__('Skills of')}}: <span class="text-yellow-300"> {{ $role->name }} </span> </x-slot>

  <div class="flex mb-4 justify-center">
    <x-primary-button :href="route('roles')" wire:navigate>{{__("Back")}}</x-primary-button>
  </div>

  <div class="flex flex-wrap pt-2 gap-y-3">
    @foreach ($abilities as $ability)
      <div class="w-1/2 md:w-1/4 lg:w-1/6" wire:key="div_{{ $ability->id }}">
        <x-toggle :key="$ability->id" :text="__($ability->name)" wire:click="toggleAbility({{ $ability->id }})" ckd="{{$role->abilities->contains($ability->id) ? true : false}}" />
      </div>
    @endforeach
  </div>

</div>
