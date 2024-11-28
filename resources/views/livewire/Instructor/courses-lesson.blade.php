<div>
    @foreach ($section->lessons as $item)
        <article class="bg-white shadow-lg rounded-lg overflow-hidden mt-4" x-data="{open:false}">
            <div class="px-6 py-4">
                @if ($lesson->id === $item->id)
                    <form wire:submit.prevent="update">
                        <!-- Nombre -->
                        <div class="flex items-center mb-4">
                            <label class="w-32 text-gray-600">Nombre:</label>
                            <input wire:model="lesson.name" class="form-input w-full rounded-lg border-gray-300 focus:ring-indigo-500" placeholder="Nombre de la lección">
                        </div>

                        @error('lesson.name')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror

                        <!-- Plataforma -->
                        <div class="flex items-center mb-4">
                            <label class="w-32 text-gray-600">Plataforma:</label>
                            <select wire:model="lesson.platform_id" class="form-select w-full rounded-lg border-gray-300 focus:ring-indigo-500">
                                @foreach ($platforms as $platform)
                                    <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- URL -->
                        <div class="flex items-center mb-4">
                            <label class="w-32 text-gray-600">URL:</label>
                            <input wire:model="lesson.url" class="form-input w-full rounded-lg border-gray-300 focus:ring-indigo-500" placeholder="URL de la lección">
                        </div>

                        @error('lesson.url')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror

                        <!-- Botones -->
                        <div class="mt-4 flex justify-end space-x-2">
                            <button type="button" wire:click="cancel" class="px-4 py-2 bg-red-400 text-white rounded-lg hover:bg-red-500">Cancelar</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Actualizar</button>
                        </div>
                    </form>
                @else
                    <!-- Vista de la lección -->
                    <header class="flex justify-between items-center">
                        <h1 x-on:click="open=!open" class="text-lg font-semibold text-gray-800 cursor-pointer"><i class="far fa-play-circle text-blue-500 mr-2"></i> Lección: {{ $item->name }}</h1>
                    </header>

                    <div class="mt-4" x-show="open">
                        <hr class="my-2">
                        <p class="text-sm text-gray-600">Plataforma: {{ $item->platform->name }}</p>
                        <p class="text-sm text-gray-600">Enlace: <a class="text-blue-500" href="{{ $item->url }}" target="_blank">{{ $item->url }}</a></p>

                        <div class="my-2 space-x-2">
                            <button class="text-sm px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700" wire:click="edit({{ $item->id }})">Editar</button>
                            <button class="text-sm px-4 py-2 bg-red-400 text-white rounded-lg hover:bg-red-500" wire:click="destroy({{ $item->id }})">Eliminar</button>
                        </div>
                        
                        <div class="mb-4">
                            @livewire('instructor.lesson-description', ['lesson' => $item], key( 'lesson-description-' . $item->id))
                        </div>

                        <div>
                            @livewire('instructor.lesson-resources', ['lesson' => $item], key( 'lesson-resources-' . $item->id))
                        </div>

                    </div>
                @endif
            </div>
        </article>
    @endforeach

    <!-- Formulario de Agregar Nueva Lección -->
    <div class="mt-6" x-data="{ open: false }">
        <a x-show="!open" @click="open = true" class="flex items-center cursor-pointer text-red-500 text-lg font-bold">
            <i class="far fa-plus-square mr-2"></i> Agregar nueva lección
        </a>

        <article class="bg-white shadow-lg rounded-lg overflow-hidden mt-4" x-show="open">
            <div class="px-6 py-4">
                <h1 class="text-xl font-bold mb-4">Agregar nueva Lección</h1>
                
                <!-- Nombre -->
                <div class="flex items-center mb-4">
                    <label class="w-32 text-gray-600">Nombre:</label>
                    <input wire:model="name" class="form-input w-full rounded-lg border-gray-300 focus:ring-indigo-500" placeholder="Nombre de la lección">
                </div>

                @error('name')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror

                <!-- Plataforma -->
                <div class="flex items-center mb-4">
                    <label class="w-32 text-gray-600">Plataforma:</label>
                    <select wire:model="platform_id" class="form-select w-full rounded-lg border-gray-300 focus:ring-indigo-500">
                        @foreach ($platforms as $platform)
                            <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                        @endforeach
                    </select>
                </div>

                @error('platform_id')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror

                <!-- URL -->
                <div class="flex items-center mb-4">
                    <label class="w-32 text-gray-600">URL:</label>
                    <input wire:model="url" class="form-input w-full rounded-lg border-gray-300 focus:ring-indigo-500" placeholder="URL de la lección">
                </div>

                @error('url')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror

                <!-- Botones -->
                <div class="flex justify-end mt-4 space-x-2">
                    <button class="px-4 py-2 bg-red-400 text-white rounded-lg hover:bg-red-500" @click="open = false">Cancelar</button>
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700" wire:click="store">Agregar</button>
                </div>
            </div>
        </article>
    </div>
</div>
