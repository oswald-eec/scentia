<x-app-layout> 
    <!-- Hero Section -->
    <section class="bg-gray-700 py-12 mb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Imagen del curso -->
            <figure>
                <img class="h-60 w-full object-cover rounded-lg shadow-md" 
                    src="{{ $course->image->url ? asset('storage/' . $course->image->url) : asset('img/default/img_default.jpg') }}" 
                    alt="Imagen del curso {{ $course->title }}" loading="lazy">
            </figure>
            <!-- Detalles del curso -->
            <div class="text-white">
                <h1 class="text-4xl font-bold">{{ $course->title }}</h1>
                <h2 class="text-xl mb-3">{{ $course->subtitle }}</h2>
                <p class="mb-2"><i class="fas fa-chart-line"></i> Nivel: {{ $course->level->name }}</p>
                <p class="mb-2"><i class="fas fa-tags"></i> Categoría: {{ $course->category->name }}</p>
                <p class="mb-2"><i class="fas fa-users"></i> Matriculados: {{ $course->students_count }}</p>
                <p><i class="far fa-star"></i> Calificación: {{ $course->rating }}</p>
            </div>
        </div>
    </section>

    <!-- Contenido principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        @if (session('info'))
            <div class="lg:col-span-3" x-data="{open:true}" x-show="open">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">¡Atención!</strong>
                    <span class="block sm:inline">{{ session('info') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg x-on:click="open=false" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            </div>
        @endif

        
        <!-- Columna principal -->
        <div class="col-span-2">
            <!-- Lo que aprenderás -->
            <section class="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
                <div class="px-6 py-4">
                    <h1 class="font-bold text-2xl mb-4">Lo que aprenderás:</h1>
                    @if ($course->goals->isNotEmpty())
                        <ul class="grid grid-cols-2 gap-x-6 gap-y-2">
                            @foreach ($course->goals as $goal)
                                <li class="text-gray-700 text-base"><i class="fas fa-check text-gray-600 mr-2"></i>{{ $goal->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">No hay objetivos definidos para este curso.</p>
                    @endif
                </div>
            </section>

            <!-- Temario -->
            <section class="mb-12">
                <h1 class="font-bold text-3xl mb-4">Temario</h1>
                @if ($course->sections->isNotEmpty())
                    @foreach ($course->sections as $section)
                        <article class="mb-4 shadow-lg rounded-lg overflow-hidden" x-data="{ open: {{ $loop->first ? 'true' : 'false' }} }">
                            <header class="border border-gray-200 px-4 py-2 cursor-pointer bg-gray-200 flex justify-between items-center" x-on:click="open = !open">
                                <h1 class="font-bold text-lg text-gray-600">{{ $section->name }}</h1>
                                <span x-show="!open"><i class="fas fa-chevron-down"></i></span>
                                <span x-show="open"><i class="fas fa-chevron-up"></i></span>
                            </header>

                            <div class="bg-white py-2 px-4" x-show="open" x-transition>
                                <ul class="grid grid-cols-1 gap-2">
                                    @foreach ($section->lessons as $lesson)
                                        <li class="text-gray-700 text-base"><i class="fas fa-play-circle mr-2 text-gray-600"></i>{{ $lesson->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </article>
                    @endforeach
                @else
                    <p class="text-gray-500">No hay secciones disponibles para este curso.</p>
                @endif
            </section>

            <!-- Requisitos -->
            <section class="mb-8">
                <h1 class="font-bold text-3xl mb-4">Requisitos</h1>
                @if ($course->requirements->isNotEmpty())
                    <ul class="list-disc list-inside text-gray-700">
                        @foreach ($course->requirements as $requirement)
                            <li class="text-base">{{ $requirement->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No hay requisitos para este curso.</p>
                @endif
            </section>

            <!-- Descripción -->
            <section class="mb-8">
                <h1 class="font-bold text-3xl mb-4">Descripción</h1>
                <div class="text-gray-700 text-base leading-relaxed">
                    @if (!empty($course->description))
                        {!! $course->description !!}
                    @else
                        <p class="text-gray-500">No hay descripción disponible para este curso.</p>
                    @endif
                </div>
            </section>
        </div>

        <!-- Columna lateral -->
        <aside>
            <!-- Información del profesor -->
            <section class="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
                <div class="px-6 py-4">
                    <div class="flex items-center">
                        <img class="h-12 w-12 object-cover rounded-full shadow-lg" 
                            src="{{ $course->teacher->profile_photo_url ? $course->teacher->profile_photo_url : asset('img/default/img_default.jpg') }}" 
                            alt="Foto de {{ $course->teacher->name }}" loading="lazy">
                        <div class="ml-4">
                            <h1 class="font-bold text-lg text-gray-500">Prof. {{ $course->teacher->name }}</h1>
                            <a class="text-blue-400 text-sm font-bold" href="">{{ '@' . Str::slug($course->teacher->name, '') }}</a>
                        </div>
                    </div>
                                        
                    <form action="{{ route('admin.courses.approved', $course) }}" method="POST">
                        @csrf
                        <button class="block text-center w-full mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300">Aprobar curso</button>
                    </form>
                    
                </div>
            </section>
        </aside>
    </div>
</x-app-layout>
