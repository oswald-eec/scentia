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
                                Lecciones
                            </a>
                        </li>
                        
                        <li>
                            <a class="leading-7 mb-1 border-l-4 @routeIs('instructor.courses.goals', $course) border-indigo-400 hover:text-indigo-600 
                                      @else border-transparent 
                                      @endif pl-2" href="{{ route('instructor.courses.goals', $course) }}">Metas</a>
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
                            {{-- <form action="{{ route('instructor.courses.status', $course) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Solicitar revisión</button>
                            </form> --}}

                            <form action="{{ route('instructor.courses.status', $course) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 transition duration-300 ease-in-out transform hover:scale-105">
                                    Solicitar revisión
                                </button>
                            </form>
                            
                            @if ($course->hotmart_url == null || $course->hotmart_id == null)
                                <div class="mt-4 p-4 rounded bg-red-300 text-red-800 flex items-center space-x-2">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M8.293 6.293a1 1 0 011.414 0L12 8.586l2.293-2.293a1 1 0 111.414 1.414L13.414 10l2.293 2.293a1 1 0 11-1.414 1.414L12 11.414l-2.293 2.293a1 1 0 11-1.414-1.414L10.586 10 8.293 7.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-xs font-semibold">Te falta completar los campos de Hotmart del Curso</p>
                                </div>
                            @else
                                <div class="mt-4 p-4 rounded bg-green-300 text-green-800 flex items-center space-x-2">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.707-10.707a1 1 0 00-1.414 0L9 12.586 7.707 11.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4a1 1 0 000-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-xs font-semibold">¡Está completo el registro! Envia la solicitud.</p>
                                </div>
                            @endif
                            
                            
                            @break

                        @case(2)
                            <div class="bg-yellow-400 shadow-lg rounded-lg overflow-hidden ">
                                <div class="px-6 py-4">
                                    <div class="text-white font-semibold">Este curso está en revisión</div>
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
