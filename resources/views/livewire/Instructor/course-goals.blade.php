{{-- <section>
    <h1 class="text-2xl font-bold">METAS DEL CURSO</h1>
    <hr class="mt-2 mb-6">

    @foreach ($course->goals as $item)
        <article class="bg-white shadow-lg rounded-lg overflow-hidden mb-4">
            <div class="px-6 py-4 bg-gray-100">
                @if ($goal->id == $item->id)
                    <form wire:submit.prevent="update">
                        <input wire:model="goal.name" class="form-input w-full">

                        @error('goal.name')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </form>
                @else
                    <header class="flex justify-between">
                        <h1>{{ $item->name }}</h1>

                        <div>
                            <i wire:click="edit({{ $item }})" class="fas fa-edit text-blue-500 cursor-pointer"></i>
                            <i wire:click="destroy({{ $item }})" class="fas fa-trash text-red-500 cursor-pointer ml-2"></i>
                        </div>
                    </header>
                @endif
            </div>
        </article>
    @endforeach

    <article class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-100">
            <form wire:submit.prevent="store">
                <input wire:model="name" class="form-input w-full" placeholder="Agregar el nombre de la meta">

                @error('name')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror

                <div class="flex justify-end mt-2">
                    <button type="submit" class="">Agregar meta</button>
                </div>
            </form>
        </div>
    </article>

</section> --}}

<section>
    <h1 class="text-2xl font-bold mb-4">Metas del Curso</h1>
    <hr class="mb-6">

    <!-- Listado de metas existentes -->
    @foreach ($course->goals as $item)
        <article class="bg-white shadow-lg rounded-lg overflow-hidden mb-4">
            <div class="px-6 py-4 bg-gray-50">
                @if ($goal->id === $item->id)
                    <!-- Formulario de edición de meta -->
                    <form wire:submit.prevent="update" class="relative">
                        <input 
                            wire:model="goal.name" 
                            class="form-input w-full pr-10 rounded-lg border-gray-300"
                            placeholder="Editar meta"
                        >

                        @error('goal.name')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </form>
                @else
                    <!-- Vista de meta con opciones de edición y eliminación -->
                    <header class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold">{{ $item->name }}</h1>
                        <div class="space-x-2">
                            <i 
                                wire:click="edit({{ $item }})" 
                                class="fas fa-edit text-blue-500 cursor-pointer hover:text-blue-600" 
                                title="Editar meta"
                            ></i>
                            <i 
                                wire:click="destroy({{ $item }})" 
                                class="fas fa-trash text-red-500 cursor-pointer hover:text-red-600" 
                                title="Eliminar meta"
                            ></i>
                        </div>
                    </header>
                @endif
            </div>
        </article>
    @endforeach

    <!-- Formulario para agregar nueva meta -->
    <article class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50">
            <form wire:submit.prevent="store">
                <input 
                    wire:model="name" 
                    class="form-input w-full rounded-lg border-gray-300"
                    placeholder="Agregar nueva meta"
                >

                @error('name')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror

                <div class="flex justify-end mt-2">
                    <button 
                        type="submit" 
                        class="bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-indigo-700"
                    >
                        Agregar Meta
                    </button>
                </div>
            </form>
        </div>
    </article>
</section>
