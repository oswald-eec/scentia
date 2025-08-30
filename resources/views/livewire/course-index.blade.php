<div>
    <!-- Filtros superiores -->
    <div class="bg-gray-50 py-4 px-4 sm:px-6 lg:px-8 mb-10 shadow-sm border-b">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center gap-4">

            <!-- Botón Reset Filtros -->
            <button wire:click="resetFilters"
                class="flex items-center px-4 py-2 bg-white text-gray-800 text-sm font-semibold rounded-lg shadow-sm hover:bg-gray-100 transition-colors duration-200"
                aria-label="Restablecer filtros">
                <i class="fas fa-archive mr-2 text-gray-500"></i>
                Todos los Cursos
            </button>

            <!-- Categoría -->
            <div class="relative" x-data="{ open: false }" x-id="['category-dropdown']">
                <button @click="open = !open"
                    class="flex items-center px-4 py-2 bg-white text-gray-800 text-sm font-semibold rounded-lg shadow-sm hover:bg-gray-100 transition-colors duration-200">
                    <i class="fas fa-layer-group mr-2 text-blue-500"></i>
                    {{ $category_id ? $categories->firstWhere('id', $category_id)->name : 'Categorías' }}
                    <svg class="w-4 h-4 ml-2 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Spinner mientras carga la categoría -->
                <div wire:loading wire:target="category_id" class="absolute top-0 right-0 mt-2 mr-2">
                    <svg class="animate-spin h-4 w-4 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10"
                            stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
                    </svg>
                </div>

                <!-- Dropdown categorías -->
                <div x-show="open" x-cloak x-transition
                    :id="$id('category-dropdown')"
                    class="absolute z-10 mt-2 w-52 bg-white border rounded-lg shadow-lg overflow-hidden">
                    @foreach ($categories as $category)
                        <a href="#"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white transition"
                           wire:click="$set('category_id', {{ $category->id }})"
                           @click="open = false">
                           {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Subcategoría -->
            <div class="relative" x-data="{ open: false }" x-id="['subcategory-dropdown']">
                <button @click="open = !open"
                    class="flex items-center px-4 py-2 bg-white text-gray-800 text-sm font-semibold rounded-lg shadow-sm hover:bg-gray-100 transition-colors duration-200"
                    :disabled="!{{ $category_id ? 'true' : 'false' }}"
                    :class="{ 'opacity-50 cursor-not-allowed': {{ $category_id ? 'false' : 'true' }} }">
                    <i class="fas fa-tags mr-2 text-purple-500"></i>
                    {{ $subcategory_id ? $subcategories->firstWhere('id', $subcategory_id)->name : 'Subcategorías' }}
                    <svg class="w-4 h-4 ml-2 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Spinner mientras carga subcategoría -->
                <div wire:loading wire:target="subcategory_id" class="absolute top-0 right-0 mt-2 mr-2">
                    <svg class="animate-spin h-4 w-4 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10"
                            stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
                    </svg>
                </div>

                <!-- Dropdown subcategorías -->
                <div x-show="open" x-cloak x-transition
                    :id="$id('subcategory-dropdown')"
                    class="absolute z-10 mt-2 w-52 bg-white border rounded-lg shadow-lg overflow-hidden">
                    @forelse ($subcategories as $subcategory)
                        <a href="#"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-500 hover:text-white transition"
                           wire:click="$set('subcategory_id', {{ $subcategory->id }})"
                           @click="open = false">
                           {{ $subcategory->name }}
                        </a>
                    @empty
                        <span class="block px-4 py-2 text-sm text-gray-400">No hay subcategorías</span>
                    @endforelse
                </div>
            </div>

            <!-- Nivel -->
            <div class="relative" x-data="{ open: false }" x-id="['level-dropdown']">
                <button @click="open = !open"
                    class="flex items-center px-4 py-2 bg-white text-gray-800 text-sm font-semibold rounded-lg shadow-sm hover:bg-gray-100 transition-colors duration-200">
                    <i class="fas fa-swatchbook mr-2 text-green-500"></i>
                    {{ $level_id ? $levels->firstWhere('id', $level_id)->name : 'Niveles' }}
                    <svg class="w-4 h-4 ml-2 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown niveles -->
                <div x-show="open" x-cloak x-transition
                    :id="$id('level-dropdown')"
                    class="absolute z-10 mt-2 w-52 bg-white border rounded-lg shadow-lg overflow-hidden">
                    @foreach ($levels as $level)
                        <a href="#"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-500 hover:text-white transition"
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($courses->isEmpty())
            <div class="bg-white border border-gray-200 rounded-lg shadow p-6 text-center text-gray-600">
                <i class="fas fa-info-circle text-blue-500 text-3xl mb-3"></i>
                <p class="text-lg font-medium">No hay cursos registrados con los filtros seleccionados.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-8">
                @foreach ($courses as $course)
                    <x-course-card :course="$course" />
                @endforeach
            </div>
        @endif
    </div>

    <!-- Paginación -->
    @if ($courses->isNotEmpty())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 mb-8">
            {{ $courses->links() }}
        </div>
    @endif

    <!-- Footer -->
    <x-footer />
</div>
