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

        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

        <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.0/ckeditor5.css" />

    </head>
    <body class="font-sans antialiased">
        <x-banner />
        
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')
            @props(['course'])
            <!-- Page Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-5 py-8 gap-4">
        
                <!-- Sidebar de navegación -->
                <aside>
                    <h1 class="font-bold text-lg mb-4">Edición del Curso</h1>
                    <ul class="text-sm text-gray-600 space-y-2 mb-4">
                        <li> 
                            <a class="leading-7 mb-1 border-l-4 
                                      @routeIs('instructor.courses.edit', $course) border-indigo-400 hover:text-indigo-600 
                                      @else border-transparent 
                                      @endif pl-2" 
                               href="{{ route('instructor.courses.edit', $course) }}">
                                Información
                            </a>
                        </li>
                        
                        <li>
                            <a class="leading-7 mb-1 border-l-4 
                                      @routeIs('instructor.courses.curriculum', $course) border-indigo-400 hover:text-indigo-600 
                                      @else border-transparent 
                                      @endif pl-2" 
                               href="{{ route('instructor.courses.curriculum', $course) }}">
                                Curriculum
                            </a>
                        </li>
                        
                        <li>
                            <a class="leading-7 mb-1 border-l-4 @routeIs('instructor.courses.goals', $course) border-indigo-400 hover:text-indigo-600 
                                      @else border-transparent 
                                      @endif pl-2" href="{{ route('instructor.courses.goals', $course) }}">Metas del Curso</a>
                        </li>
                        <li>
                            <a class="leading-7 mb-1 border-l-4 @routeIs('instructor.courses.students', $course) border-indigo-400 hover:text-indigo-600 
                            @else border-transparent 
                            @endif pl-2" href="{{ route('instructor.courses.students', $course) }}">Estudiantes</a>
                        </li>
                    </ul>
                    {{-- {{ $course }} --}}
                    <!-- Status del curso -->
                    @switch($course->status)
                        @case(1)
                            <form action="{{ route('instructor.courses.status', $course) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Solicitar revisión</button>
                            </form>
                            @break

                        @case(2)
                            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                                <div class="px-6 py-4">
                                    <div class="text-yellow-600 font-semibold">Este curso está en revisión</div>
                                </div>
                            </div>
                            @break

                        @case(3)
                            <div class="text-green-600 font-semibold">Este curso está publicado</div>
                            @break

                        @default
                            <div class="text-gray-600 font-semibold">Estado desconocido</div>
                    @endswitch

                </aside>
        
                <!-- Contenedor principal de edición del curso -->
                <main class="bg-white shadow-lg rounded-lg overflow-hidden col-span-4 p-6">
                    {{ $slot }}
                </main>
            </div>

        </div>

        @stack('modals')

        @livewireScripts

        @isset($js)
            {{ $js }}
        @endisset
    </body>
</html>
