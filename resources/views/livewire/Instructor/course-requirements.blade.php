<section>
    <h1 class="text-2xl font-bold mb-4">Requerimientos del Curso</h1>
    <hr class="mb-6">

    <!-- Listado de requerimientos existentes -->
    @foreach ($course->requirements as $item)
        <article class="bg-white shadow-lg rounded-lg overflow-hidden mb-4">
            <div class="px-6 py-4 bg-gray-50">
                @if ($requirement->id === $item->id)
                    <!-- Formulario de edición de requerimiento -->
                    <form wire:submit.prevent="update" class="relative">
                        <input 
                            wire:model="requirement.name" 
                            class="form-input w-full pr-10 rounded-lg border-gray-300"
                            placeholder="Editar requerimiento"
                        >
                        
                        @error('requirement.name')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </form>
                @else
                    <!-- Vista del requerimiento con opciones de edición y eliminación -->
                    <header class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold">{{ $item->name }}</h1>
                        <div class="space-x-2">
                            <i 
                                wire:click="edit({{ $item }})" 
                                class="fas fa-edit text-blue-500 cursor-pointer hover:text-blue-600" 
                                title="Editar requerimiento"
                            ></i>
                            <i 
                                wire:click="destroy({{ $item }})" 
                                class="fas fa-trash text-red-500 cursor-pointer hover:text-red-600" 
                                title="Eliminar requerimiento"
                            ></i>
                        </div>
                    </header>
                @endif
            </div>
        </article>
    @endforeach

    <!-- Formulario para agregar nuevo requerimiento -->
    <article class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50">
            <form wire:submit.prevent="store">
                <input 
                    wire:model="name" 
                    class="form-input w-full rounded-lg border-gray-300"
                    placeholder="Agregar el nombre del requerimiento"
                >

                @error('name')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror

                <div class="flex justify-end mt-2">
                    <button 
                        type="submit" 
                        class="bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-indigo-700"
                    >
                        Agregar Requerimiento
                    </button>
                </div>
            </form>
        </div>
    </article>

</section>
