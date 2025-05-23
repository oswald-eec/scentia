<div class="max-w-2xl mx-auto mt-4">
    <form autocomplete="off" class="relative">
        <!-- Caja de búsqueda -->
        <div class="relative">
            <!-- Icono de búsqueda -->
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <!-- Input de búsqueda -->
            <input wire:model="search" type="search" id="default-search" 
                   class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 
                          focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 
                          dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                   placeholder="Busca tu curso..." required>
            
            <!-- Botón de búsqueda -->
            <button type="submit" 
                    class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none 
                           focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 
                           dark:focus:ring-blue-800">
                Buscar
            </button>
            
            <!-- Resultados de búsqueda -->
            @if($search)
                <ul class="absolute z-50 left-0 w-full bg-white mt-1 rounded-lg shadow-lg overflow-hidden">
                    @forelse ($this->results as $result)
                        <li class="leading-10 px-5 text-sm cursor-pointer hover:bg-gray-300">
                            <a href="{{ route('course.show', $result) }}">{{ $result->title }}</a>
                        </li>
                    @empty
                        <li class="leading-10 px-5 text-sm text-gray-700 cursor-pointer">
                            No hay ninguna coincidencia...
                        </li>
                    @endforelse                
                </ul>
            @endif
        </div>
    </form>
</div>