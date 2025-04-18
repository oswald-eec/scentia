@props(['course'])

<article class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-xl duration-300 ease-in-out">
    <!-- Imagen del curso con lazy loading para mejorar rendimiento -->
    <img class="h-36 w-full object-cover" 
         src="{{ asset('storage/' . $course->image->url) }}" 
         alt="Imagen del curso {{ $course->title }}" 
         loading="lazy">

    <div class="px-6 py-4">
        <!-- Título del curso, limitado a 40 caracteres -->
        <h1 class="text-xl font-semibold text-gray-800 mb-2 leading-6" title="{{ $course->title }}">
            {{ Str::limit($course->title, 30, '...') }}
        </h1>
        
        <!-- Nombre del profesor del curso -->
        <p class="text-gray-500 text-xs mb-2">
            <i class="fas fa-chalkboard-teacher mr-1"></i> 
            Prof: {{ $course->teacher->name }}
        </p>
        
        <!-- Sección de estrellas de calificación -->
        <div class="flex items-center">
            <ul class="flex text-sm space-x-1">
                @for ($i = 1; $i <= 5; $i++)
                    <li>
                        <i class="fas fa-star text-{{ $course->rating >= $i ? 'yellow' : 'gray' }}-400"></i>
                    </li>
                @endfor
            </ul>
            <!-- Cantidad de estudiantes -->
            <p class="text-sm text-gray-500 ml-auto flex items-center">
                <i class="fas fa-users mr-1"></i> {{ $course->students_count }}
            </p>
        </div>

        <!-- Precio del curso -->
        <p class="text-sm font-bold mt-3">
            @if ($course->price->value == 0)
                <span class="text-red-600"><i class="fas fa-gift mr-1"></i> GRATIS</span>
            @else
                <span class="text-gray-800"><i class="fas fa-dollar-sign mr-1"></i> {{ number_format($course->price->value, 2) }} BS</span>
            @endif
        </p>

        <!-- Botón de "Más Información" -->
        {{-- <a href="{{ route('course.show', $course) }}" 
           class="block text-center w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            Más Información
        </a> --}}

        <!-- Botón dinámico según si el usuario está inscrito -->
        @auth
            @if (auth()->user()->courses_enrolled->contains($course->id))
                <a href="{{ route('course.show', $course) }}" 
                    class="block text-center w-full mt-4 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition-colors duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                    Estas Inscrito
                </a>
            @else
                <a href="{{ route('course.show', $course) }}" 
                   class="block text-center w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Más Información
                </a>
            @endif
        @else
            <a href="{{ route('course.show', $course)  }}" 
               class="block text-center w-full mt-4 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition-colors duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50">
               Más Información
            </a>
        @endauth
    </div>
</article>
