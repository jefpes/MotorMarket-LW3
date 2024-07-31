<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
  <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <livewire:navigation />

    <!-- Page Heading -->
    @isset($header)
      <header class="bg-white dark:bg-gray-800 shadow">
        <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between">
          <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $header }}
          </h2>
          @persist('theme')
          <button id="theme-toggle" type="button"
            class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg px-4">
            <x-icons.moon id="theme-toggle-dark-icon" />
            <x-icons.sun id="theme-toggle-light-icon" />
          </button>
          @endpersist
        </div>
      </header>
    @endisset

    <!-- Page Content -->
    <div class="sm:py-6 py-1">
      <div class="mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-4 text-gray-900 dark:text-gray-100">
            {{ $slot }}
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
