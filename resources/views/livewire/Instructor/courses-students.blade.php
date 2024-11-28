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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($students as $student)
                        <tr class="hover:bg-gray-50">
                            {{-- Columna de Nombre y Foto --}}
                            <td class="px-6 py-4 whitespace-nowrap flex items-center">
                                <img 
                                    class="h-10 w-10 rounded-full mr-4 object-cover" 
                                    src="{{ $student->profile_photo_url ? asset('storage/' . $student->profile_photo_url) : asset('img/default/perfil.png') }}" 
                                    alt="Imagen del estudiante"
                                >
                                <div class="text-sm font-semibold text-gray-900">
                                    {{ $student->name }}
                                </div>
                            </td>

                            {{-- Columna de Email --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $student->email }}
                            </td>

                            {{-- Columna de Acciones --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900 font-medium">Ver</a>
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
            {{-- Mensaje sin resultados --}}
            <div class="px-6 py-4 text-center text-gray-500">
                No se encontraron estudiantes inscritos.
            </div>
        @endif
    </x-table-responsive>
</div>
