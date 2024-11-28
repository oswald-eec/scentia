<div class="bg-white shadow-lg rounded-lg overflow-hidden" x-data="{ open: false }">
    <div class="px-6 py-4 bg-gray-100">
        <header>
            <h1 @click="open = !open" class="cursor-pointer font-semibold text-gray-800">
                Recursos de la lección
            </h1>
        </header>

        <div x-show="open" class="mt-4">
            <hr class="my-2">

            @if ($lesson->resource)
                <div class="flex justify-between items-center">
                    <p class="text-gray-700">
                        <i wire:click="download" class="fas fa-download text-blue-500 mr-2 cursor-pointer"></i>
                        {{ $lesson->resource->url }}
                    </p>
                    <i wire:click="destroy" class="fas fa-trash text-red-500 cursor-pointer hover:text-red-700"></i>
                </div>
            @else
                <form wire:submit.prevent="save">
                    <div class="flex items-center">
                        <input wire:model="file" type="file" class="form-input flex-1 rounded-md border-gray-300">
                        <button type="submit" class="bg-indigo-600 text-white  px-4 py-1 rounded-md ml-2 hover:bg-indigo-700">
                            Guardar
                        </button>
                    </div>

                    <!-- Mensaje de carga -->
                    <div class="text-blue-500 font-bold mt-1" wire:loading wire:target="file">
                        Cargando ...
                    </div>

                    <!-- Error de validación -->
                    @error('file')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </form>
            @endif
        </div>
    </div>
</div>
