<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <!-- Título -->
    <h2 class="text-3xl font-bold text-gray-800 mb-10 text-center flex items-center justify-center">
        
        Mis Cursos Inscritos
    </h2>

    <!-- Filtro -->
    <div class="mb-10 max-w-xs mx-auto">
        <label for="estadoFiltro" class="block text-sm font-medium text-gray-700 mb-2">
            Filtrar por estado:
        </label>
        <select wire:model="estadoFiltro" id="estadoFiltro"
            class="w-full rounded-lg border-gray-300 shadow-sm text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            <option value="todos">Todos</option>
            <option value="cursando">Cursando</option>
            <option value="pendiente_aprobacion">Pendiente</option>
            <option value="no_pagado">No Pagado</option>
        </select>
    </div>

    <!-- Cursos -->
    @if($courses->isEmpty())
        <div class="bg-white p-10 rounded-xl shadow-md text-center text-gray-500">
            <i class="fas fa-info-circle text-4xl text-gray-400 mb-3"></i>
            <p class="text-lg">No tienes cursos en este estado.</p>
        </div>
    @else
        <!-- Grid responsive -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($courses as $course)
                <article
                    class="bg-white shadow-lg rounded-xl overflow-hidden transition-transform transform hover:scale-105 hover:shadow-xl duration-300 ease-in-out flex flex-col">

                    <!-- Imagen -->
                    <img class="h-40 w-full object-cover"
                        src="{{ asset('storage/' . $course->image->url) }}"
                        alt="Imagen del curso {{ $course->title }}" loading="lazy">

                    <!-- Contenido -->
                    <div class="p-5 flex-1 flex flex-col">
                        <!-- Título -->
                        <h3 class="text-lg font-semibold text-gray-800 mb-2 leading-tight" title="{{ $course->title }}">
                            {{ Str::limit($course->title, 40, '...') }}
                        </h3>

                        <!-- Instructor -->
                        <p class="text-xs text-gray-500 mb-3 flex items-center">
                            <i class="fas fa-chalkboard-teacher mr-1 text-blue-500"></i>
                            {{ $course->teacher->name }}
                        </p>

                        <!-- Rating y estudiantes -->
                        <div class="flex items-center mb-3">
                            <ul class="flex text-sm space-x-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <li>
                                        <i class="fas fa-star {{ $course->rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                    </li>
                                @endfor
                            </ul>
                            <p class="text-xs text-gray-500 ml-auto flex items-center">
                                <i class="fas fa-users mr-1"></i> {{ $course->students_count }}
                            </p>
                        </div>

                        <!-- Estado -->
                        <p class="text-sm font-medium mb-4">
                            Estado:
                            @switch($course->status)
                                @case('cursando')
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-green-100 text-green-700">
                                        <i class="fas fa-play mr-1"></i> Cursando
                                    </span>
                                    @break

                                @case('pendiente_aprobacion')
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-yellow-100 text-yellow-700">
                                        <i class="fas fa-clock mr-1"></i> Pendiente
                                    </span>
                                    @break

                                @default
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-gray-100 text-gray-500">
                                        <i class="fas fa-ban mr-1"></i> No Pagado
                                    </span>
                            @endswitch
                        </p>

                        <!-- Botón dinámico -->
                        <div class="mt-auto">
                            @if($course->status === 'cursando' || $course->status === 'pendiente_aprobacion')
                                <a href="{{ route('course.show', $course) }}"
                                    class="block text-center w-full mt-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-300">
                                    Ver Curso
                                </a>
                            @elseif($course->status === 'no_pagado')
                                <a href="{{ route('payment.options', $course) }}"
                                    class="block text-center w-full mt-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-300">
                                    Pagar Curso
                                </a>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</div>

<!-- Footer -->
<x-footer />
