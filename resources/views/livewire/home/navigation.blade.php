<nav id="header" class="w-full z-30 top-0 py-1 bg-white dark:bg-gray-800">
  <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">

    {{-- <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1" id="menu">
      <nav>
        <ul class="md:flex items-center justify-between text-base text-gray-700 dark:text-gray-200 pt-4 md:pt-0">
          <li><a class="inline-block no-underline hover:text-black hover:underline py-2 px-4" href="#"> {{ __('About') }} </a></li>
        </ul>
      </nav>
    </div> --}}

    <div class="order-1 md:order-2 ">
      <a class="flex items-center tracking-wide no-underline hover:no-underline font-bold text-gray-800 dark:text-gray-200 text-xl" href="{{ route('home') }}">
        <svg class="fill-current text-gray-800 dark:text-gray-200 mr-2" width="24" height="24" viewBox="0 0 24 24">
          <path d="M5,22h14c1.103,0,2-0.897,2-2V9c0-0.553-0.447-1-1-1h-3V7c0-2.757-2.243-5-5-5S7,4.243,7,7v1H4C3.447,8,3,8.447,3,9v11 C3,21.103,3.897,22,5,22z M9,7c0-1.654,1.346-3,3-3s3,1.346,3,3v1H9V7z M5,10h2v2h2v-2h6v2h2v-2h2l0.002,10H5V10z" />
        </svg>
        Motor Market
      </a>
    </div>

    <div class="order-2 md:order-3 flex items-center" id="nav-content">
      @persist('theme')
      <button class="text-gray-800 dark:text-gray-200 pr-2 flex items-center tracking-wide no-underline hover:no-underline font-bold"
        id="theme-toggle" type="button"
        class="hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg px-4">
        <x-icons.moon id="theme-toggle-dark-icon" />
        <x-icons.sun id="theme-toggle-light-icon" />
      </button>
      @endpersist
      <a class="text-gray-800 dark:text-gray-200 inline-block no-underline hover:text-black" href="{{ route('login') }}" wire:navigate>
        <svg class="fill-current hover:text-black" width="24" height="24" viewBox="0 0 24 24">
          <circle fill="none" cx="12" cy="7" r="3" />
          <path
            d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z" />
        </svg>
      </a>
    </div>
  </div>
</nav>
