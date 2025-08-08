<div>
    <!-- Barra de filtros -->
    {{-- <div class="bg-gray-200 py-2 mb-16 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center">
            <!-- Botón de resetear filtros -->
            <button class="bg-white shadow h-12 px-4 rounded-lg text-gray-700 flex items-center mr-4 hover:bg-gray-100 transition-colors duration-200"
                    wire:click="resetFilters" aria-label="Restablecer filtros">
                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-hidden="true">
                    <path d="M32 32l448 0c17.7 0 32 14.3 32 32l0 32c0 17.7-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96L0 64C0 46.3 14.3 32 32 32zm0 128l448 0 0 256c0 35.3-28.7 64-64 64L96 480c-35.3 0-64-28.7-64-64l0-256zm128 80c0 8.8 7.2 16 16 16l160 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-160 0c-8.8 0-16 7.2-16 16z"/>
                </svg>
                Todos los Cursos
            </button>

            <!-- Dropdown de Categorías -->
            <div class="relative" x-data="{ openCategory: false }">
                <button class="bg-white shadow h-12 px-4 rounded-lg text-gray-700 flex items-center hover:bg-gray-100 transition-colors duration-200"
                        x-on:click="openCategory = !openCategory" aria-expanded="openCategory" aria-haspopup="true">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-hidden="true">
                        <path d="M345 39.1L472.8 168.4c52.4 53 52.4 138.2 0 191.2L360.8 472.9c-9.3 9.4-24.5 9.5-33.9 .2s-9.5-24.5-.2-33.9L438.6 325.9c33.9-34.3 33.9-89.4 0-123.7L310.9 72.9c-9.3-9.4-9.2-24.6 .2-33.9s24.6-9.2 33.9 .2z"/>
                    </svg>
                    Categoría
                    <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-hidden="true">
                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                    </svg>
                </button>

                <!-- Lista desplegable de categorías -->
                <div class="absolute right-0 w-40 mt-2 py-2 bg-white border rounded shadow-xl z-10" x-show="openCategory" x-on:click.away="openCategory = false">
                    @foreach ($categories as $category)
                        <a href="#" class="block px-4 py-2 text-gray-900 hover:bg-blue-500 hover:text-white transition-colors duration-200"
                           wire:click="$set('category_id', {{ $category->id }})"
                           x-on:click="openCategory = false">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Dropdown de Niveles -->
            <div class="relative ml-4" x-data="{ openLevel: false }">
                <button class="bg-white shadow h-12 px-4 rounded-lg text-gray-700 flex items-center hover:bg-gray-100 transition-colors duration-200"
                        x-on:click="openLevel = !openLevel" aria-expanded="openLevel" aria-haspopup="true">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-hidden="true">
                        <path d="M345 39.1L472.8 168.4c52.4 53 52.4 138.2 0 191.2L360.8 472.9c-9.3 9.4-24.5 9.5-33.9 .2s-9.5-24.5-.2-33.9L438.6 325.9c33.9-34.3 33.9-89.4 0-123.7L310.9 72.9c-9.3-9.4-9.2-24.6 .2-33.9s24.6-9.2 33.9 .2z"/>
                    </svg>
                    Niveles
                    <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-hidden="true">
                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                    </svg>
                </button>

                <!-- Lista desplegable de niveles -->
                <div class="absolute right-0 w-40 mt-2 py-2 bg-white border rounded shadow-xl z-10" x-show="openLevel" x-on:click.away="openLevel = false">
                    @foreach ($levels as $level)
                        <a href="#" class="block px-4 py-2 text-gray-900 hover:bg-blue-500 hover:text-white transition-colors duration-200"
                           wire:click="$set('level_id', {{ $level->id }})"
                           x-on:click="openLevel = false">
                            {{ $level->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div> --}}
    <div class="bg-gray-100 py-4 px-4 sm:px-6 lg:px-8 mb-10 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center md:justify-start gap-4">
        
        <!-- Botón Reset Filtros -->
        <button wire:click="resetFilters"
            class="flex items-center px-4 py-2 bg-white text-gray-800 text-sm font-medium rounded-lg shadow hover:bg-gray-200 transition-colors duration-200"
            aria-label="Restablecer filtros">
            <i class='fas fa-archive mr-2 text-gray-500' style='font-size:20px'></i>
            Todos los Cursos
        </button>

        <!-- Dropdown Categorías -->
        <div class="relative" x-data="{ open: false }" x-id="['category-dropdown']">
            <button @click="open = !open"
                class="flex items-center px-4 py-2 bg-white text-gray-800 text-sm font-medium rounded-lg shadow hover:bg-gray-200 transition-colors duration-200"
                :aria-expanded="open"
                :aria-controls="$id('category-dropdown')">

                <i class='fas fa-layer-group mr-2 text-gray-500' style='font-size:20px'></i>
                
                Categoría
                <svg class="w-4 h-4 ml-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" x-cloak x-transition
                :id="$id('category-dropdown')"
                class="absolute z-10 mt-2 w-44 bg-white border rounded-lg shadow-lg overflow-hidden">
                @foreach ($categories as $category)
                    <a href="#" class="block px-4 py-2 text-sm text-gray-800 hover:bg-blue-500 hover:text-white transition"
                        wire:click="$set('category_id', {{ $category->id }})"
                        @click="open = false">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Dropdown Niveles -->
        <div class="relative" x-data="{ open: false }" x-id="['level-dropdown']">
            <button @click="open = !open"
                class="flex items-center px-4 py-2 bg-white text-gray-800 text-sm font-medium rounded-lg shadow hover:bg-gray-200 transition-colors duration-200"
                :aria-expanded="open"
                :aria-controls="$id('level-dropdown')">
                <i class='fas fa-swatchbook mr-2 text-gray-500' style='font-size:20px'></i>

                Niveles
                <svg class="w-4 h-4 ml-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" x-cloak x-transition
                :id="$id('level-dropdown')"
                class="absolute z-10 mt-2 w-44 bg-white border rounded-lg shadow-lg overflow-hidden">
                @foreach ($levels as $level)
                    <a href="#" class="block px-4 py-2 text-sm text-gray-800 hover:bg-blue-500 hover:text-white transition"
                        wire:click="$set('level_id', {{ $level->id }})"
                        @click="open = false">
                        {{ $level->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>


    <!-- Tarjetas de cursos -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-8">
        @foreach ($courses as $course)
            <x-course-card :course="$course" />
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 mb-8">
        {{ $courses->links() }}
    </div>

    <!-- Footer -->
    <x-footer />
</div>
