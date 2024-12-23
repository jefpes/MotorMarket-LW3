<nav class="container mx-auto p-2  flex items-center justify-between ">
  <div class="flex items-center">
    @if ($company->logo && Storage::exists("/$company->logo"))
    <a href="{{ route('home') }}" class="flex items-center">
      <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name ?? 'Motor Market' }}"
        class="h-12 w-auto">
    </a>
    @else
    <a href="{{ route('home') }}" class="flex items-center text-2xl font-bold text-gray-900">
      {{ $company->name ?? 'Motor Market' }}
    </a>
    @endif
  </div>

  <div class="flex items-center space-x-4">
    <a href="{{ route('login') }}"
      class="flex items-center px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-200">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
      </svg>
      Login
    </a>
  </div>
</nav>
