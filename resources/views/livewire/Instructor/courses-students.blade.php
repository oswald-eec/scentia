<div>
    <h1 class="text-2xl font-bold mb-4">Estudiantes Inscritos</h1>

    <x-table-responsive>
        {{-- Barra de búsqueda --}}
        <div class="px-6 py-4 flex items-center">
            <input 
                wire:model="search"  
                class="form-input w-full shadow-sm rounded-lg border-gray-300" 
                placeholder="Buscar estudiante por nombre o correo..."
            >
        </div>

        {{-- Tabla de estudiantes --}}
        @if ($students->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($students as $student)
                        <tr class="hover:bg-gray-50">
                            {{-- Nombre y Foto --}}
                            <td class="px-6 py-4 whitespace-nowrap flex items-center">
                                <img class="h-10 w-10 rounded-full mr-4 object-cover" 
                                     src="{{ $student['profile_photo_url'] ? asset('storage/' . $student->profile_photo_url) : asset('img/default/perfil.png') }}" 
                                     alt="Imagen del estudiante">
                                <div class="text-sm font-semibold text-gray-900">
                                    {{ $student->name }}
                                </div>
                            </td>

                            {{-- Email --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $student->email }}
                            </td>

                            {{-- Acciones --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                <div class="flex space-x-3 justify-end">
                                    {{-- Notas --}}
                                    <button wire:click="showNotes({{ $student->id }})" 
                                            class="text-blue-600 hover:text-blue-800 font-medium">
                                        Notas
                                    </button>

                                    {{-- Certificado --}}
                                    <button wire:click="showCertificate({{ $student->id }})" 
                                            class="text-green-600 hover:text-green-800 font-medium">
                                        Certificado
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Paginación --}}
            <div class="px-6 py-4">
                {{ $students->links() }}
            </div>
        @else
            <div class="px-6 py-4 text-center text-gray-500">
                No se encontraron estudiantes inscritos.
            </div>
        @endif
    </x-table-responsive>

    {{-- MODAL DE NOTAS --}}
    <x-dialog-modal wire:model="showNotesModal">
        <x-slot name="title">
            Notas de {{ $selectedStudent?->name }}
        </x-slot>
        <x-slot name="content">
            @if($selectedStudent)
                @php
                    $attempts = \App\Models\ExamAttempt::whereHas('exam', fn($q)=>$q->where('course_id',$course->id))
                                ->where('user_id',$selectedStudent->id)->get();
                    $promedio = $attempts->avg('score');
                @endphp
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Examen</th>
                            <th class="py-2">Nota</th>
                            <th class="py-2">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attempts as $attempt)
                            <tr>
                                <td class="py-1">{{ $attempt->exam->title }}</td>
                                <td class="py-1">{{ $attempt->score ?? 'Sin nota' }}</td>
                                <td class="py-1">
                                    {{ $attempt->passed ? '✅ Aprobado' : '❌ Reprobado' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4 font-bold">
                    Promedio final: {{ $promedio ? number_format($promedio,2) : 'N/A' }}
                </div>
            @endif
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showNotesModal', false)">
                Cerrar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    {{-- MODAL DE CERTIFICADO --}}
    {{-- <x-dialog-modal wire:model="showCertificateModal">
        <x-slot name="title">
            Certificado de {{ $selectedStudent?->name }}
        </x-slot>
        <x-slot name="content">
            @if($selectedStudent)
                @php
                    $certificate = \App\Models\Certificate::where('course_id',$course->id)
                                    ->where('user_id',$selectedStudent->id)->first();
                @endphp

                @if($certificate)
                    <p class="text-green-600 mb-2">Ya existe un certificado cargado.</p>
                    <a href="{{ Storage::url($certificate->file_path) }}" target="_blank" class="text-blue-600 underline">
                        Ver certificado
                    </a>
                @endif

                <div class="mt-4">
                    <input type="file" wire:model="certificateFile">
                    @error('certificateFile') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            @endif
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showCertificateModal', false)">
                Cancelar
            </x-secondary-button>
            <x-button wire:click="uploadCertificate" class="ml-2">
                Subir Certificado
            </x-button>
        </x-slot>
    </x-dialog-modal> --}}
    {{-- MODAL DE CERTIFICADO --}}
<x-dialog-modal wire:model="showCertificateModal">
    {{-- Título --}}
    <x-slot name="title">
        Certificado de {{ $selectedStudent?->name }}
    </x-slot>

    {{-- Contenido --}}
    <x-slot name="content">
        @if($selectedStudent)
            @php
                $certificate = \App\Models\Certificate::where('course_id', $course->id)
                                ->where('user_id', $selectedStudent->id)
                                ->first();
            @endphp

            @if($certificate)
                <p class="text-green-600 mb-2">Ya existe un certificado cargado.</p>
                <a href="{{ Storage::url($certificate->file_path) }}" 
                   target="_blank" 
                   class="text-blue-600 underline">
                   Ver certificado
                </a>
            @endif

            {{-- Input para subir --}}
            <div class="mt-4">
                <input type="file" wire:model="certificateFile" class="block w-full text-sm text-gray-600">
                @error('certificateFile') 
                    <span class="text-red-600">{{ $message }}</span> 
                @enderror

                {{-- Barra de progreso opcional --}}
                <div wire:loading wire:target="certificateFile" class="mt-2 text-blue-500">
                    Subiendo archivo...
                </div>
            </div>
        @endif
    </x-slot>

    {{-- Footer (botones de acción) --}}
    <x-slot name="footer">
        <x-secondary-button wire:click="$set('showCertificateModal', false)">
            Cancelar
        </x-secondary-button>

        {{-- Aquí va el submit real --}}
        <x-button wire:click="uploadCertificate" class="ml-2">
            Subir Certificado
        </x-button>
    </x-slot>
</x-dialog-modal>

</div>
