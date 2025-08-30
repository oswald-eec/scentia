<div class="space-y-8">

    {{-- Título principal --}}
    <h1 class="text-3xl font-extrabold text-gray-800">Exámenes del curso</h1>

    {{-- Formulario para crear examen --}}
    <div class="bg-white shadow-md rounded-lg p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Crear nuevo examen</h2>

        <form wire:submit.prevent="store" class="space-y-4">

            {{-- Título --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Título</label>
                <input type="text" 
                       wire:model="title" 
                       class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-700" 
                       placeholder="Ej: Examen Final">
                @error('title') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            {{-- Descripción --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Descripción</label>
                <textarea wire:model="description" 
                          class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-700"
                          placeholder="Agrega una breve descripción del examen..."></textarea>
                @error('description') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            {{-- Puntajes --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Puntaje máximo</label>
                    <input type="number" 
                           wire:model="max_score" 
                           class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-700" 
                           placeholder="Ej: 100">
                    @error('max_score') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Puntaje aprobación</label>
                    <input type="number" 
                           wire:model="passing_score" 
                           class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-700" 
                           placeholder="Ej: 70">
                    @error('passing_score') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Botón --}}
            <div class="flex justify-end">
                <button type="submit" 
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Crear examen
                </button>
            </div>
        </form>
    </div>

    {{-- Listado de exámenes --}}
    <div class="bg-white shadow-md rounded-lg p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Exámenes registrados</h2>

        @if($exams->count())
            <table class="min-w-full border divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Título</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Puntaje</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($exams as $exam)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $exam->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $exam->description ?? '—' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 text-center">
                                Máx: {{ $exam->max_score }} <br>
                                Aprob.: {{ $exam->passing_score }}
                            </td>
                            <td class="px-6 py-4 text-sm text-center">
                                <a href="{{ route('instructor.courses.exams.attempts', [$course, $exam]) }}" 
                                   class="px-3 py-1 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
                                    Gestionar notas
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-gray-500 text-center py-6">
                No se han registrado exámenes en este curso todavía.
            </div>
        @endif
    </div>

</div>
