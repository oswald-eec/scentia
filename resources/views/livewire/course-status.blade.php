<div class="mt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Sección principal: Video + Lección -->
        <div class="col-span-2">
            <div class="relative overflow-hidden rounded-2xl shadow-xl aspect-w-16 aspect-h-9 bg-gray-200">
                @if ($embedUrl)
                    <iframe 
                        class="absolute top-0 left-0 w-full h-full rounded-2xl" 
                        src="{{ $embedUrl }}" 
                        allowfullscreen 
                        loading="lazy">
                    </iframe>
                @else
                    <p class="text-gray-500 text-center py-6">Este video no está disponible.</p>
                @endif
            </div>

            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mt-6">{{ $current->name }}</h2>

            @if ($current->description)
                <p class="text-gray-600 mt-2 text-sm md:text-base leading-relaxed">
                    {{ $current->description->name }}
                </p>
            @endif

            <!-- Acciones -->
            <div class="flex justify-between items-center mt-6">
                <!-- Completar lección -->
                <button wire:click="completed"
                    class="flex items-center px-3 py-2 rounded-lg shadow-sm text-sm font-medium
                           {{ $current->complete ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    <i class="fas {{ $current->complete ? 'fa-check-circle text-blue-600' : 'fa-circle text-gray-400' }} mr-2"></i>
                    {{ $current->complete ? 'Lección completada' : 'Marcar como completada' }}
                </button>

                <!-- Descargar recurso -->
                @if ($current->resource)
                    <button wire:click="download"
                        class="flex items-center px-3 py-2 bg-green-100 text-green-700 rounded-lg shadow-sm hover:bg-green-200 transition text-sm font-medium">
                        <i class="fas fa-download mr-2"></i> Descargar Recurso
                    </button>
                @endif
            </div>

            <!-- Navegación -->
            <div class="bg-white shadow-md rounded-lg mt-6 flex justify-between px-6 py-4">
                @if ($this->previous)
                    <a wire:click="changeLesson({{ $this->previous->id }})" 
                       class="cursor-pointer text-indigo-600 hover:underline font-medium">
                        ← Anterior
                    </a>
                @else
                    <span></span>
                @endif

                @if ($this->next)
                    <a wire:click="changeLesson({{ $this->next->id }})" 
                       class="cursor-pointer text-indigo-600 hover:underline font-medium">
                        Siguiente →
                    </a>
                @endif
            </div>

            <!-- Comentarios -->
            <div class="mt-8">
                @livewire('lesson-comments', ['lesson' => $current], key('lesson-comments-'.$current->id))
            </div>
        </div>


        <!-- Panel lateral: Curso + Progreso -->
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
            <div class="px-6 py-6">
                <h1 class="text-2xl font-bold text-center text-gray-900">{{ $course->title }}</h1>
                
                <!-- Profesor -->
                <div class="flex items-center mt-4">
                    <img class="h-12 w-12 rounded-full shadow-md object-cover" 
                         src="{{ $course->teacher->profile_photo_url }}" 
                         alt="Foto de {{ $course->teacher->name }}" loading="lazy">
                    <div class="ml-4">
                        <h2 class="font-semibold text-gray-700">Prof. {{ $course->teacher->name }}</h2>
                        <a class="text-indigo-500 text-xs font-bold" href="#">
                            {{ '@' . Str::slug($course->teacher->name, '') }}
                        </a>
                    </div>
                </div>

                <!-- Progreso -->
                <p class="text-gray-600 text-sm mt-4">{{ $this->advance }}% Completado</p>
                <div class="relative pt-1">
                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                        <div class="bg-blue-500 h-3 rounded-full transition-all duration-700"
                            style="width: {{ $this->advance }}%;">
                        </div>
                    </div>
                </div>

                <!-- Lista de secciones y lecciones -->
                <ul class="mt-6 space-y-4">
                    @foreach ($course->sections as $section)
                        <li>
                            <p class="font-semibold text-gray-800">{{ $section->name }}</p>
                            <ul class="mt-2 pl-4 space-y-1 text-gray-600">
                                @foreach ($section->lessons as $lesson)
                                    <li class="flex items-center text-sm">
                                        <span class="w-3 h-3 mr-2 rounded-full
                                            {{ $lesson->complete ? 'bg-green-500' : 'bg-gray-300' }}
                                            {{ $lesson->id == $current->id ? 'ring-2 ring-indigo-400' : '' }}">
                                        </span>
                                        <a wire:click="changeLesson({{ $lesson->id }})"
                                           class="cursor-pointer hover:text-indigo-600 transition">
                                            {{ $lesson->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>

                <!-- Botón Notas -->
                <div class="mt-8 text-center">
                    <x-button wire:click="$set('showGradesModal', true)" 
                              class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow-md">
                        Ver Notas
                    </x-button>
                </div>
            </div>

            {{-- MODAL DE NOTAS + CERTIFICADO --}}
            @include('components.student-grades-modal')
        </div>
    </div>
</div>

<!-- Footer -->
<x-footer />