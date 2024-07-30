<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
  <!-- Primary Navigation Menu -->
  <div class="mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <div class="flex flex-wrap">
        <!-- Logo -->
        <div class="shrink-0 flex items-center">
          <x-icons.home class="cursor-pointer w-auto fill-current text-gray-800 dark:text-gray-200 pr-2"
            :href="route('home')" wire:navigate />
        </div>

        <!-- Navigation Links -->
        @foreach ($this->navs as $nav)
          @can($nav->permission)
            <div class="hidden sm:-my-px sm:mr-2 sm:flex">
              <x-nav-link :href="route($nav->route)" :active="$nav->isActive" wire:navigate> {{ __($nav->label) }} </x-nav-link>
            </div>
          @endcan
        @endforeach

        <!-- Vehicle Dropdown -->
        <div class="hidden sm:-my-px sm:mr-2 sm:flex">
          <x-nav-link-father-son megaMenuIconsDropdown="vehicle-menu-icon" menuIconsDropdownButton="vehicle-menu-icons"
            :itemsMenuDropdownButton="$this->vehicleNavs" label="Vehicle"
            :active="request()->routeIs(['vehicle','vehicle.show','vehicle.create','vehicle.edit','vmodel','vtype', 'brand'])" />
        </div>

        <!-- Financial Dropdown -->
        <div class="hidden sm:-my-px sm:mr-2 sm:flex">
          <x-nav-link-father-son megaMenuIconsDropdown="financial-menu-icon" menuIconsDropdownButton="financial-menu-icons"
            :itemsMenuDropdownButton="$this->financialNavs" label="Financial"
            :active="request()->routeIs(['sale.create', 'sale.show', 'sales', 'sale.installments', 'installments', 'vehicle-expense'])" />
        </div>
      </div>

      <!-- Settings Dropdown -->
      <div class="hidden sm:flex sm:items-center sm:ms-6">
        <x-nav-link>
        <x-dropdown>
          <x-slot name="trigger">
            <button
              class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
              <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                x-on:profile-updated.window="name = $event.detail.name"></div>

              <div class="ms-1">
                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
                </svg>
              </div>
            </button>
          </x-slot>

          <x-slot name="content">
            {{-- @if (session('localization') == 'pt_BR' || !session('localization'))
            <x-dropdown-link wire:click="setLang('en')" class="cursor-pointer w-full text-start"> English
            </x-dropdown-link>
            @else
            <x-dropdown-link wire:click="setLang('pt_BR')" class="cursor-pointer w-full text-start"> Português
            </x-dropdown-link>
            @endif --}}
            <x-dropdown-link :href="route('profile')" wire:navigate> {{ __('Profile') }} </x-dropdown-link>

            <x-dropdown-link wire:click="logout" class="cursor-pointer w-full text-start"> {{ __('Log Out') }}
            </x-dropdown-link>
          </x-slot>
        </x-dropdown>
        </x-nav-link>
      </div>

      <!-- Hamburger -->
      <div class="-me-2 flex items-center sm:hidden">
        <button @click="open = ! open"
          class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Responsive Navigation Menu -->
  <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
    @foreach ($this->responsiveNavs as $nav)
    @can($nav->permission)
    <x-responsive-nav-link :href="route($nav->route)" :active="$nav->isActive" wire:navigate> {{ __($nav->label) }}
    </x-responsive-nav-link>
    @endcan
    @endforeach

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
      <div class="px-4">
        <div class="font-medium text-base text-gray-800 dark:text-gray-200"
          x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
          x-on:profile-updated.window="name = $event.detail.name"></div>
        <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
      </div>

      <div class="mt-3 space-y-1">
        {{-- @if (session('localization') == 'pt_BR' || !session('localization'))
        <x-responsive-nav-link wire:click="setLang('en')"> English </x-responsive-nav-link>
        @else
        <x-responsive-nav-link wire:click="setLang('pt_BR')"> Português </x-responsive-nav-link>
        @endif --}}
        <x-responsive-nav-link :href="route('profile')" wire:navigate> {{ __('Profile') }} </x-responsive-nav-link>

        <!-- Authentication -->
        <button wire:click="logout" class="w-full text-start">
          <x-responsive-nav-link> {{ __('Log Out') }} </x-responsive-nav-link>
        </button>
      </div>
    </div>
  </div>
</nav>
