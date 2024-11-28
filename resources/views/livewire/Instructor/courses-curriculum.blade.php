<div>
    
    <h1 class="text-2xl font-bold text-gray-700 mb-6">Lecciones del Curso</h1>

    @foreach ($course->sections as $item)
        <article class="bg-white shadow-lg rounded-lg overflow-hidden mb-6" x-data="{ open: false }">
            <div class="px-6 py-4 bg-gray-100">
                @if ($section->id === $item->id)
                <form wire:submit.prevent="update" class="relative">
                    <input 
                        wire:model="section.name" 
                        class="form-input w-full rounded-lg pr-10" 
                        placeholder="Ingrese el nombre de la sección"
                    >
                
                    @error('section.name')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </form>
                
                                        
                @else
                    <header class="flex justify-between items-center">
                        <h1 x-on:click="open=!open" class="cursor-pointer"> <strong>Sección:</strong> {{ $item->name }} </h1>
                        <div>
                            <i class="fas fa-edit cursor-pointer text-blue-500" wire:click="edit({{ $item->id }})"></i>
                            <i class="fas fa-trash-alt cursor-pointer text-red-500" wire:click="destroy({{ $item->id }})"></i>
                        </div>
                    </header>

                    <div x-show="open">
                        @livewire('instructor.courses-lesson', ['section' => $item], key($item->id))
                    </div>

                @endif
            </div>
        </article>
    @endforeach

    <!-- Formulario de Agregar Nueva Sección -->
    <div x-data="{ open: false }">
        <a x-show="!open" @click="open = true" class="flex items-center cursor-pointer text-red-500 text-lg font-bold">
            <i class="far fa-plus-square mr-2"></i> Agregar nueva sección
        </a>

        <article class="bg-white shadow-lg rounded-lg overflow-hidden mt-4" x-show="open">
            <div class="px-6 py-4 bg-gray-100">
                <h1 class="text-xl font-bold mb-4">Agregar nueva sección</h1>
                <div>
                    <input wire:model="name" class="form-input w-full rounded-lg" placeholder="Escriba el nombre de la sección">
                    @error('name')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-end mt-4 space-x-2">
                    <button class="px-4 py-2 bg-red-400 text-white rounded-lg hover:bg-red-500" @click="open = false">Cancelar</button>
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700" wire:click="store">Agregar</button>
                </div>
            </div>
        </article>
    </div>
</div>
