<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <x-table-responsive>
        
        {{-- Barra de búsqueda --}}
        <div class="px-6 py-4 flex">
            <input 
                wire:keydown="limpiar_page" 
                wire:model="search"  
                class="form-input flex-1 shadow-sm rounded" 
                placeholder="Buscar curso por nombre...">

            <a class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg ml-2" href="{{ route('instructor.courses.create') }}">Nuevo Curso</a>
        </div>
        
        {{-- Tabla de cursos --}}
        @if ($courses->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Matriculados</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Calificación</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($courses as $course)
                        <tr>
                            {{-- Columna de Nombre y Categoría --}}
                            <td class="px-6 py-4 whitespace-nowrap flex items-center">
                                
                                @isset($course->image)
                                    <img class="h-10 w-10 rounded-full mr-4" src="{{ asset('storage/' . $course->image->url) }}" alt="Imagen del curso">
                                @else
                                    <img class="h-10 w-10 rounded-full mr-4" src="{{ asset('img/default/img_default.jpg') }}" alt="Imagen del curso">
                                @endisset

                                <div>
                                    <div class="text-sm font-semibold text-gray-900">{{ $course->title }}</div>
                                    <div class="text-sm text-gray-500">{{ $course->category->name }}</div>
                                </div>
                            </td>
                            
                            {{-- Columna de Matriculados --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $course->students->count() }}</div>
                                <div class="text-sm text-gray-500">Estudiantes Matriculados</div>
                            </td>
                            
                            {{-- Columna de Calificación --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-900 mr-2">{{ $course->rating }}</span>
                                    <ul class="flex space-x-1 text-yellow-400">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <li><i class="fas fa-star {{ $course->rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}"></i></li>
                                        @endfor
                                    </ul>
                                </div>
                                <div class="text-sm text-gray-500">Valoración del curso</div>
                            </td>
                            
                            {{-- Columna de Estado --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $course->status == 1 ? 'bg-red-100 text-red-800' : ($course->status == 2 ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                    {{ $course->status == 1 ? 'Borrador' : ($course->status == 2 ? 'Revisión' : 'Publicado') }}
                                </span>
                            </td>
                            
                            {{-- Columna de Edición --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('course.show', $course) }}" class="text-green-600 hover:text-green-900 mr-4">Ver</a>
                                <a href="{{ route('instructor.courses.edit',$course) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                            </td>   
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{-- Paginación --}}
            <div class="px-6 py-4">
                {{ $courses->links() }}
            </div>
        @else
            {{-- Mensaje sin resultados --}}
            <div class="px-6 py-4 text-center text-gray-500">
                No se encontraron cursos que coincidan.
            </div>
        @endif
    </x-table-responsive>
</div>
