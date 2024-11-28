<div>
    <article class="bg-white shadow-lg rounded-lg overflow-hidden" x-data="{ open: false }">
        <div class="px-6 py-4 bg-gray-100">
            <header>
                <h1 x-on:click="open = !open" class="cursor-pointer font-semibold text-gray-700">
                    Descripción de la lección
                </h1>
            </header>

            <div x-show="open" x-transition class="mt-2">
                <hr class="my-2">

                @if ($lesson->description)
                    <form wire:submit.prevent="update">
                        <textarea wire:model="description.name" class="form-input w-full rounded-lg border-gray-300" placeholder="Editar descripción de la lección"></textarea>

                        @error('description.name')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror

                        <div class="flex justify-end space-x-2 mt-3">
                            <button type="button" wire:click="destroy" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                Eliminar
                            </button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                Actualizar
                            </button>
                        </div>
                    </form>
                @else
                    <div>
                        <textarea wire:model="name" class="form-input w-full rounded-lg border-gray-300" placeholder="Agregue una descripción de la lección"></textarea>

                        @error('name')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror

                        <div class="flex justify-end space-x-2 mt-3">
                            <button wire:click="store" type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                                Agregar
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </article>
</div>
