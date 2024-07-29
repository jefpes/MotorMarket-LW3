<nav id="header" class="w-full top-0 bg-white dark:bg-gray-800">
  <div class="w-full container flex flex-wrap items-center justify-between mt-0 py-3">
    <div class="flex-1 pl-2 md:pl-4">
      @if ($company->logo && Storage::exists("/$company->logo"))
        <a class="max-h-8 max-w-48" href="{{ route('home') }}">
          <img class="max-h-8 max-w-48" src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name ?? 'Motor Market' }}" />
        </a>
      @else
        <a class="flex items-center tracking-wide no-underline hover:no-underline font-bold text-gray-800 hover:text-blue-500 dark:text-gray-200 dark:hover:text-blue-500 text-xl" href="{{ route('home') }}">
          <svg class="fill-current mr-2" width="24" height="24" viewBox="0 0 24 24">
            <path d="M5,22h14c1.103,0,2-0.897,2-2V9c0-0.553-0.447-1-1-1h-3V7c0-2.757-2.243-5-5-5S7,4.243,7,7v1H4C3.447,8,3,8.447,3,9v11 C3,21.103,3.897,22,5,22z M9,7c0-1.654,1.346-3,3-3s3,1.346,3,3v1H9V7z M5,10h2v2h2v-2h6v2h2v-2h2l0.002,10H5V10z" />
          </svg>
          {{ $company->name ?? 'Motor Market' }}
        </a>
      @endif
    </div>

    <div class="flex flex-0 items-center">
      @persist('theme')
      <button
        id="theme-toggle" type="button"
        class="dark:hover:text-blue-500 hover:text-blue-500  rounded-lg px-4 text-gray-800 dark:text-gray-200 pr-2 flex items-center">
        <x-icons.moon id="theme-toggle-dark-icon" />
        <x-icons.sun id="theme-toggle-light-icon" />
      </button>
      @endpersist
      <a class="text-gray-800 hover:text-blue-500 dark:text-gray-200 dark:hover:text-blue-500" href="{{ route('login') }}" wire:navigate>
        <svg class="fill-current w-6 h-6" viewBox="0 0 24 24">
          <circle fill="none" cx="12" cy="7" r="3" />
          <path
            d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z" />
        </svg>
      </a>
    </div>
  </div>
</nav>
