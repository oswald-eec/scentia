<x-app-layout>
    <!-- Hero Section -->
    <section class="bg-gray-700 py-12 mb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Imagen del curso -->
            <figure>
                <img class="h-60 w-full object-cover rounded-lg shadow-md" src="{{ asset('storage/' . $course->image->url) }}" alt="Imagen del curso {{ $course->title }}" loading="lazy">
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
        <!-- Columna principal -->
        <div class="col-span-2">
            <!-- Lo que aprenderás -->
            <section class="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
                <div class="px-6 py-4">
                    <h1 class="font-bold text-2xl mb-4">Lo que aprenderás:</h1>
                    <ul class="grid grid-cols-2 gap-x-6 gap-y-2">
                        @foreach ($course->goals as $goal)
                            <li class="text-gray-700 text-base"><i class="fas fa-check text-gray-600 mr-2"></i>{{ $goal->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </section>

            <!-- Temario -->
            <section class="mb-12">
                <h1 class="font-bold text-3xl mb-4">Temario</h1>
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
            </section>

            <!-- Requisitos -->
            <section class="mb-8">
                <h1 class="font-bold text-3xl mb-4">Requisitos</h1>
                <ul class="list-disc list-inside text-gray-700">
                    @foreach ($course->requirements as $requirement)
                        <li class="text-base">{{ $requirement->name }}</li>
                    @endforeach
                </ul>
            </section>

            <!-- Descripción -->
            <section class="mb-8">
                <h1 class="font-bold text-3xl mb-4">Descripción</h1>
                <div class="text-gray-700 text-base leading-relaxed">
                    {{ $course->description }}
                </div>
            </section>

            @livewire('courses-reviews', ['course' => $course])

        </div>

        <!-- Columna lateral -->
        <aside>
            <!-- Información del profesor -->
            <section class="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
                <div class="px-6 py-4">
                    <div class="flex items-center">
                        <img 
                            class="h-12 w-12 object-cover rounded-full shadow-lg" 
                            src="{{ $course->teacher->profile_photo_url }}" 
                            alt="Foto de {{ $course->teacher->name }}" 
                            loading="lazy">
                        <div class="ml-4">
                            <h1 class="font-bold text-lg text-gray-700">Prof. {{ $course->teacher->name }}</h1>
                            <a class="text-blue-500 text-sm font-bold hover:underline" href="#">
                                {{ '@' . Str::slug($course->teacher->name, '') }}
                            </a>
                        </div>
                    </div>

                    {{-- @can('enrolled', $course)
                        <a 
                            class="block text-center w-full mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300" 
                            href="{{ route('course.status', $course) }}">
                            Continuar con el Curso
                        </a>
                    @else
                        @if ($course->price->value == 0)
                            <!-- Indicador de curso GRATIS -->
                            <p class="text-2xl font-bold text-green-500 inline-block py-1 px-3 mt-3 mb-2">GRATIS</p>
                            <form action="{{ route('courses.enrolled', $course) }}" method="POST">
                                @csrf
                                <button 
                                    class="block text-center w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                                    Llevar el curso
                                </button>
                            </form>
                        @else
                            <!-- Precio del curso -->
                            <p class="text-2xl font-bold text-gray-700 mt-3 mb-2">BS {{ number_format($course->price->value, 2) }}</p>
                            <a 
                                href="{{ route('payment.checkout', $course) }}" 
                                class="block text-center w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                                Comprar este Curso
                            </a>
                        @endif
                    @endcan --}}
                    @can('enrolled', $course)
                        <a 
                            class="block text-center w-full mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300" 
                            href="{{ route('course.status', $course) }}">
                            Continuar con el Curso
                        </a>
                    @else
                        @if ($hasPendingAirtm)
                            <!-- Botón deshabilitado por pago pendiente vía AirTM -->
                            <p class="text-yellow-600 text-sm font-medium mt-3 mb-1 text-center">
                                Tu comprobante está en revisión. No puedes realizar otro pago por ahora.
                            </p>
                            <button 
                                class="block text-center w-full bg-yellow-400 text-white font-bold py-2 px-4 rounded opacity-70 cursor-not-allowed"
                                disabled>
                                Pago Pendiente de Aprobación (AirTM)
                            </button>
                        @elseif ($course->price->value == 0)
                            <!-- Curso gratuito -->
                            <p class="text-2xl font-bold text-green-500 inline-block py-1 px-3 mt-3 mb-2">GRATIS</p>
                            <form action="{{ route('courses.enrolled', $course) }}" method="POST">
                                @csrf
                                <button 
                                    class="block text-center w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                                    Llevar el curso
                                </button>
                            </form>
                        @else
                            <!-- Curso pagado -->
                            <p class="text-2xl font-bold text-gray-700 mt-3 mb-2">
                                Bs {{ number_format($course->price->value, 2) }}
                            </p>
                            <a 
                                href="{{ route('payment.checkout', $course) }}" 
                                class="block text-center w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                                Comprar este Curso
                            </a>
                        @endif
                    @endcan


                </div>
            </section>


            <!-- Cursos Similares -->
            <section>
                <h2 class="font-bold text-xl mb-4">Cursos Similares</h2>
                @foreach ($similares as $similar)
                <article class="flex mb-6">
                    <figure>
                        @if ($similar->image)
                            <img class="h-32 w-40 object-cover rounded-lg shadow" src="{{ asset('storage/' . $similar->image->url) }}" alt="Imagen del curso similar {{ $similar->title }}" loading="lazy">
                        @else
                            <img class="h-32 w-40 object-cover rounded-lg shadow" src="{{ asset('images/placeholder-course.jpg') }}" alt="Imagen por defecto" loading="lazy">
                        @endif
                    </figure>
                    <div class="ml-3">
                        <h3 class="font-bold text-gray-500 mb-3">
                            <a href="{{ route('course.show', $similar) }}">
                                {{ Str::limit($similar->title, 40, '...') }}
                            </a>
                        </h3>
                        <div class="flex items-center mb-2">
                            <img class="h-8 w-8 object-cover rounded-full shadow-lg" src="{{ $similar->teacher->profile_photo_url }}" alt="Foto de {{ $similar->teacher->name }}" loading="lazy">
                            <p class="text-gray-700 text-sm ml-2">{{ $similar->teacher->name }}</p>
                        </div>
                        <p class="text-yellow-500"><i class="fas fa-star mr-2"></i>{{ $similar->rating }}</p>
                    </div>
                </article>
                @endforeach
            </section>
        </aside>
    </div>
</x-app-layout>
