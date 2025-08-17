<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <h2 class="text-2xl font-bold text-gray-800 mb-4">Mis Cursos Inscritos</h2>

    <!-- Filtro por estado -->
    <div class="mb-6 max-w-xs">
        <label for="estadoFiltro" class="block text-sm font-medium text-gray-700 mb-1">Filtrar por estado:</label>
        <select wire:model="estadoFiltro" id="estadoFiltro" class="form-select w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200">
            <option value="todos">Todos</option>
            <option value="cursando">Cursando</option>
            <option value="pendiente_aprobacion">Pendiente</option>
        </select>
    </div>

    @if($courses->isEmpty())
        <div class="bg-white p-6 rounded shadow text-center text-gray-500">
            No tienes cursos en este estado.
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($courses as $course)
                <div class="bg-white border rounded shadow p-4 flex flex-col justify-between">
                    <img 
                        src="{{ asset('storage/' . $course->image->url) }}"
                        alt="{{ $course->title }}"
                        class="w-full h-40 object-cover rounded mb-4">

                    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $course->title }}</h3>
                    <p class="text-sm text-gray-500 mb-2">Instructor: {{ $course->teacher->name }}</p>

                    <p class="text-sm font-medium mb-4">
                        Estado:
                        @switch($course->status)
                            @case('cursando')
                                <span class="text-green-600 font-semibold">Cursando</span>
                                @break

                            @case('pendiente_aprobacion')
                                <span class="text-yellow-600 font-semibold">Pendiente de Aprobación</span>
                                @break

                            @default
                                <span class="text-gray-500">No Pagado</span>
                        @endswitch
                    </p>

                    @if($course->status === 'cursando')
                        <a href="{{ route('course.show', $course) }}"
                        class="mt-auto inline-block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                            Ver Curso
                        </a>
                    @elseif($course->status === 'pendiente_aprobacion')
                        <a href="{{ route('course.show', $course) }}"
                        class="mt-auto inline-block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                            Ver Curso
                        </a>
                    @elseif($course->status === 'no_pagado')
                        <a href="{{ route('payment.options', $course) }}"
                        class="mt-auto inline-block text-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded transition">
                            Pagar Curso
                        </a>
                    @endif

                </div>
            @endforeach
        </div>
    @endif

    <!-- Footer -->
    <x-footer />

</div>
