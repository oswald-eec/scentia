<div class="mt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Primera sección: span de 2 columnas en pantallas grandes -->
        <div class="col-span-2 bg-gray-100">
            <div class="relative overflow-hidden rounded-lg aspect-w-16 aspect-h-9">
                <iframe 
                    class="absolute top-0 left-0 w-full h-full rounded-lg" 
                    src="{{ $current->url }}" 
                    allowfullscreen 
                    loading="lazy">
                </iframe>
            </div>

            <h2 class="text-3xl text-gray-600 font-bold mt-4">{{ $current->name }}</h2>
            <h2 class="text-3xl text-gray-600 font-bold mt-4">El iframe es: {{ $current->url }}</h2>

            @if ($current->description)
                <div class="text-gray-600 mt-2">
                    {{ $current->description->name }}
                </div>
            @endif

            <div class="flex justify-between items-center mt-4">
                <!-- Botón de completar lección -->
                <div class="flex items-center cursor-pointer" 
                     wire:click="completed" 
                     role="button" 
                     aria-pressed="{{ $current->complete ? 'true' : 'false' }}">
                    <i class="fas text-2xl {{ $current->complete ? 'text-blue-600' : 'text-gray-600' }}">
                        <span class="{{ $current->complete ? 'fas fa-toggle-on' : 'fas fa-toggle-off' }}"></span>
                    </i>
                    <p class="text-sm ml-2 font-medium text-gray-800">
                        {{ $current->complete ? 'Lección marcada como completada' : 'Marcar esta unidad como culminada' }}
                    </p>
                </div>
            
                <!-- Botón de descargar recurso -->
                @if ($current->resource)
                    <div class="flex items-center text-gray-600 cursor-pointer hover:text-blue-600 transition duration-300"
                         wire:click="download"
                         role="button" 
                         title="Descargar recurso">
                        <i class="fas fa-download text-lg"></i>
                        <p class="text-sm ml-2 font-medium">Descargar Recurso</p>
                    </div>
                @endif
            </div>
            

            <!-- Navegación -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden mt-4">
                <div class="px-6 py-4 flex text-gray-500 font-bold">
                    @if ($this->previous)
                        <a wire:click="changeLesson({{ $this->previous }})" class="cursor-pointer" href="">Anterior</a>
                    @endif
                    @if ($this->next)
                        <a wire:click="changeLesson({{ $this->next }})" class="ml-auto cursor-pointer" href="">Siguiente</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Segunda sección: Información del curso y progreso -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4">
                <h1 class="text-2xl leading-8 text-center mb-4 font-bold text-gray-800">{{ $course->title }}</h1>
                <div class="flex items-center mt-4">
                    <img class="h-12 w-12 object-cover rounded-full shadow-lg" src="{{ $course->teacher->profile_photo_url }}" alt="Foto de {{ $course->teacher->name }}" loading="lazy">
                    <div class="ml-4">
                        <h1 class="font-bold text-lg text-gray-500">Prof. {{ $course->teacher->name }}</h1>
                        <a class="text-blue-400 text-sm font-bold" href="#">{{ '@' . Str::slug($course->teacher->name, '') }}</a>
                    </div>
                </div>

                <p class="text-gray-600 text-sm mt-2">{{ $this->advance }}% Completado</p>

                <div class="relative pt-1">
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                        <div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"
                            style="width: {{ $this->advance }}%;">
                        </div>
                    </div>
                </div>


                <ul class="mt-4">
                    @foreach ($course->sections as $section)
                        <li class="text-gray-700 mb-4">
                            <a class="font-bold text-base inline-block mb-2" href="#">{{ $section->name }}</a>
                            <ul class="mt-2 pl-4 text-gray-600">
                                @foreach ($section->lessons as $lesson)
                                <li class="flex mt-1 items-center">
                                    <!-- Indicador de lección con color y borde condicional -->
                                    <span class="w-4 h-4 mr-2 mt-1 rounded-full
                                        {{ $lesson->complete ? ($lesson->id == $current->id ? 'border-2 border-yellow-500' : 'bg-yellow-500') : ($lesson->id == $current->id ? 'border-2 border-gray-500' : 'bg-gray-500') }}">
                                    </span>

                                    <a class="cursor-pointer" 
                                       wire:click="changeLesson({{ $lesson }})">
                                        {{ $lesson->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>