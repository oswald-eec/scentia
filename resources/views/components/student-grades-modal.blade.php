<x-dialog-modal wire:model="showGradesModal" maxWidth="2xl">
    <x-slot name="title">
        <h2 class="text-xl font-bold text-gray-800">
            Notas del curso: {{ $course->title }}
        </h2>
    </x-slot>

    <x-slot name="content">
        @php
            $user = auth()->user();
            $exams = $course->exams()
                        ->with(['students' => fn($q) => $q->where('user_id', $user->id)])
                        ->get();
        @endphp

        {{-- Tabla de notas --}}
        @if($exams->count())
            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="w-full text-sm text-gray-700">
                    <thead>
                        <tr class="bg-gray-100 text-left text-xs uppercase tracking-wider text-gray-600">
                            <th class="px-4 py-3">Examen</th>
                            <th class="px-4 py-3">Nota</th>
                            <th class="px-4 py-3">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @php $total = 0; $count = 0; @endphp
                        @foreach($exams as $exam)
                            @php
                                $pivot = $exam->students->first()?->pivot;
                                $nota = $pivot?->score;
                                if($nota !== null){ $total += $nota; $count++; }
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium">{{ $exam->title }}</td>
                                <td class="px-4 py-3">
                                    {{ $nota ?? '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    @if($nota !== null)
                                        @if($nota >= $exam->passing_score)
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-700">
                                                <i class="fas fa-check-circle mr-1"></i> Aprobado
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded bg-red-100 text-red-700">
                                                <i class="fas fa-times-circle mr-1"></i> Reprobado
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-gray-400">Sin nota</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Promedio final --}}
            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg text-center">
                <p class="text-lg font-bold text-gray-700">
                    Promedio final:
                    <span class="text-blue-600">
                        {{ $count > 0 ? round($total / $count, 2) : 'N/A' }}
                    </span>
                </p>
            </div>
        @else
            <p class="text-gray-600">No tienes exámenes registrados en este curso.</p>
        @endif

        {{-- Certificado --}}
        <div class="mt-8 border-t pt-6">
            <h3 class="text-lg font-bold text-gray-700 mb-3 flex items-center">
                <i class="fas fa-award text-yellow-500 mr-2"></i> Certificado
            </h3>

            @php
                $certificate = \App\Models\Certificate::where('course_id', $course->id)
                                ->where('user_id', auth()->id())
                                ->first();
            @endphp

            @if($certificate)
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-center justify-between">
                    <p class="text-green-700 font-medium">
                        ¡Felicidades! Tu certificado está disponible.
                    </p>
                    <a href="{{ Storage::url($certificate->file_path) }}" 
                        target="_blank" 
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                        <i class="fas fa-download mr-2"></i> Descargar
                    </a>
                </div>
            @else
                <p class="text-gray-500">El instructor aún no ha subido tu certificado.</p>
            @endif
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('showGradesModal', false)">
            Cerrar
        </x-secondary-button>
    </x-slot>
</x-dialog-modal>
