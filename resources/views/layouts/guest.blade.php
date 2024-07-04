<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/caticon.svg') }}">


    @stack('head')

    <!-- Fonts -->
    @googlefonts
    @googlefonts('display')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @filamentStyles
    @livewireStyles
    @stack('styles')
</head>

<body class="font-mono">
    @include('front.partials.navbar')
    @livewire('partials.alert-banner')
    <div class="text-gray-900 dark:text-gray-100 antialiased">
        {{ $slot }}
    </div>
    @include('front.partials.footer')

    @filamentScripts
    @livewireScripts
    @stack('scripts')
</body>

</html>
