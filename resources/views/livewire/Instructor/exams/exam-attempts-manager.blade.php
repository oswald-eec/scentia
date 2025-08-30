<div class="space-y-6">

    {{-- Título --}}
    <h1 class="text-3xl font-extrabold text-gray-800">
        Notas - {{ $exam->title }}
    </h1>

    {{-- Tabla de notas --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Estudiante</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Nota</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Estado</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($students as $student)
                    <tr class="hover:bg-gray-50 transition">
                        {{-- Estudiante --}}
                        <td class="px-6 py-4 whitespace-nowrap flex items-center">
                            <img class="h-10 w-10 rounded-full mr-3 object-cover"
                                 src="{{ $student['profile_photo_url'] ?? asset('img/default/perfil.png') }}"
                                 alt="Foto de {{ $student['name'] }}">
                            <span class="text-sm font-medium text-gray-900">{{ $student['name'] }}</span>
                        </td>

                        {{-- Email --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $student['email'] }}
                        </td>

                        {{-- Nota --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <input type="number" 
                                   min="0" 
                                   max="{{ $exam->max_score }}" 
                                   wire:change="saveAttempt({{ $student['id'] }}, $event.target.value)"
                                   value="{{ $student['score'] }}"
                                   class="w-20 px-2 py-1 text-center border rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-800">
                        </td>

                        {{-- Estado aprobado/reprobado --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if ($student['passed'])
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                    Aprobado
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                    Reprobado
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
