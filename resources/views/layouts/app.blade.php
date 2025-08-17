<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Scientia Academy') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <!-- Styles -->
        @livewireStyles

        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
        
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

        <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.0/ckeditor5.css" />

    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        @isset($js)
            {{ $js }}
        @endisset
    </body>
</html>
