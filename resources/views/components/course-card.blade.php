@props(['course'])

<article 
    class="bg-white shadow-md rounded-xl overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl duration-300 ease-in-out flex flex-col">

    <!-- Imagen del curso -->
    <div class="relative">
        <img class="h-40 w-full object-cover"
            src="{{ asset('storage/' . $course->image->url) }}"
            alt="Imagen del curso {{ $course->title }}"
            loading="lazy">

        <!-- Precio destacado -->
        <div class="absolute top-2 right-2">
            @if ($course->price->value == 0)
                <span class="bg-red-600 text-white text-xs font-bold px-2 py-1 rounded shadow">
                    <i class="fas fa-gift mr-1"></i> GRATIS
                </span>
            @else
                <span class="bg-gray-800 text-white text-xs font-bold px-2 py-1 rounded shadow">
                    {{ number_format($course->price->value, 2) }} BS
                </span>
            @endif
        </div>
    </div>

    <!-- Contenido -->
    <div class="p-5 flex-1 flex flex-col">
        <!-- Título -->
        <h1 class="text-lg font-bold text-gray-900 mb-2 leading-tight line-clamp-2">
            {{ Str::limit($course->title, 40, '...') }}
        </h1>

        <!-- Profesor -->
        <p class="text-sm text-gray-500 mb-2 flex items-center">
            <i class="fas fa-chalkboard-teacher mr-1 text-blue-500"></i>
            {{ $course->teacher->name }}
        </p>

        <!-- Rating y estudiantes -->
        <div class="flex items-center mb-3">
            <ul class="flex text-yellow-400 text-sm">
                @for ($i = 1; $i <= 5; $i++)
                    <li>
                        <i class="fas fa-star {{ $course->rating >= $i ? '' : 'text-gray-300' }}"></i>
                    </li>
                @endfor
            </ul>
            <p class="text-xs text-gray-500 ml-auto flex items-center">
                <i class="fas fa-users mr-1"></i> {{ $course->students_count }}
            </p>
        </div>

        <!-- Botón dinámico -->
        <div class="mt-auto">
            @auth
                @if (auth()->user()->courses_enrolled->contains($course->id))
                    <a href="{{ route('course.show', $course) }}"
                        class="block text-center w-full mt-2 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition">
                        <i class="fas fa-check-circle mr-1"></i> Estás Inscrito
                    </a>
                @else
                    <a href="{{ route('course.show', $course) }}"
                        class="block text-center w-full mt-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition">
                        <i class="fas fa-info-circle mr-1"></i> Más Información
                    </a>
                @endif
            @else
                <a href="{{ route('course.show', $course) }}"
                    class="block text-center w-full mt-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition">
                    <i class="fas fa-sign-in-alt mr-1"></i> Más Información
                </a>
            @endauth
        </div>
    </div>
</article>
