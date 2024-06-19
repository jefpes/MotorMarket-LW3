<footer class="container mx-auto bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 py-2 px-2 border-t border-gray-400">
  <div class="container flex">
    <div class="w-full mx-auto flex flex-wrap">
      <div class="flex w-full lg:w-1/2 ">
        <div class="px-3 md:px-0">
          <h3 class="font-bold text-gray-900 dark:text-gray-200">{{ __('About') }}</h3>
          <p class="py-4 text-gray-800 dark:text-gray-200">{{ $company->about ?? 'Motor Market is a platform for buying and selling cars.' }}
          </p>
        </div>
      </div>
      <div class="flex w-full lg:w-1/2 lg:justify-end lg:text-right mt-6 md:mt-0">
        <div class="px-3 md:px-0">
          <h3 class="text-left font-bold text-gray-800 dark:text-gray-200">{{ __('Contacts') }}</h3>

          <div class="w-full flex items-center py-4 mt-0">
            @isset($company->x)
              <a href="{{ 'https://'.$company->x }}" target="_blank" class="mx-2"> <x-icons.x /> </a>
            @endisset
            @isset($company->facebook)
              <a href="{{ 'https://'.$company->facebook }}" target="_blank" class="mx-2"> <x-icons.facebook /> </a>
            @endisset
            @isset($company->instagram)
              <a href="{{ 'https://'.$company->instagram }}" target="_blank" class="mx-2"> <x-icons.instagram /> </a>
            @endisset
            @isset($company->linkedin)
              <a href="{{ 'https://'.$company->linkedin }}" target="_blank" class="mx-2"> <x-icons.linkedin /> </a>
            @endisset
            @isset($company->youtube)
              <a href="{{ 'https://'.$company->youtube }}" target="_blank" class="mx-2"> <x-icons.youtube /> </a>
            @endisset
            @isset($company->whatsapp)
              <a href="{{ 'https://'.$company->whatsapp }}" target="_blank" class="mx-2"> <x-icons.whatsapp /> </a>
            @endisset
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
