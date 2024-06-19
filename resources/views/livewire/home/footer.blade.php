<footer class="container mx-auto bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 py-2 px-2 border-t border-gray-400">
  <div class="container flex">
    <div class="w-full mx-auto flex flex-wrap">
      <div class="flex w-full lg:w-1/2 ">
        <div class="px-3 md:px-0 space-y-2">
          <h3 class="font-bold text-gray-900 dark:text-gray-200">{{ __('About') }}</h3>
          <p class="text-gray-800 dark:text-gray-200">{{ $company->about ?? 'Motor Market is a platform for buying and selling cars.' }}
          @if($company->address)
            <p class="text-gray-800 dark:text-gray-200"><span class="font-bold text-gray-900 dark:text-gray-200">{{ __('Address') }}:</span> {{ $company->address }} </p>
          @endif
          @if($company->cnpj)
            <p class="text-gray-800 dark:text-gray-200"><span class="font-bold text-gray-900 dark:text-gray-200">{{ __('CNPJ') }}:</span> {{ $company->cnpj }} </p>
          @endif
        </div>
      </div>
      <div class="flex w-full lg:w-1/2 lg:justify-end lg:text-right mt-6 md:mt-0">
        <div class="px-3 md:px-0">
          <h3 class="text-left font-bold text-gray-800 dark:text-gray-200">{{ __('Contacts') }}</h3>

          <div class="w-full flex items-center py-4 mt-0">
            @if($company->x)
              <a href="{{ 'https://'.$company->x }}" target="_blank" class="mx-2"> <x-icons.x /> </a>
            @endif
            @if($company->facebook)
              <a href="{{ 'https://'.$company->facebook }}" target="_blank" class="mx-2"> <x-icons.facebook /> </a>
            @endif
            @if($company->instagram)
              <a href="{{ 'https://'.$company->instagram }}" target="_blank" class="mx-2"> <x-icons.instagram /> </a>
            @endif
            @if($company->linkedin)
              <a href="{{ 'https://'.$company->linkedin }}" target="_blank" class="mx-2"> <x-icons.linkedin /> </a>
            @endif
            @if($company->youtube)
              <a href="{{ 'https://'.$company->youtube }}" target="_blank" class="mx-2"> <x-icons.youtube /> </a>
            @endif
            @if($company->whatsapp)
              <a href="{{ 'https://'.$company->whatsapp }}" target="_blank" class="mx-2"> <x-icons.whatsapp /> </a>
            @endif
          </div>
          @if($company->phone)
            <div class="mx-2 text-gray-800 dark:text-gray-200"><span class="font-bold text-gray-900 dark:text-gray-200">{{ __('Phone') }}:</span> {{ $company->phone }} </div>
          @endif
          @if($company->email)
            <div class="mx-2 text-gray-800 dark:text-gray-200"><span class="font-bold text-gray-900 dark:text-gray-200">{{ __('E-mail') }}:</span> {{ $company->email }} </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</footer>
