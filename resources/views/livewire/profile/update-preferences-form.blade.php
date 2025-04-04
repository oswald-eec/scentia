<x-form-section submit="updatePreferences">
    <x-slot name="title">
        {{ __('Preferencias de Cursos') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Selecciona las categorías de cursos que te interesan.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Categorías -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="categories" value="{{ __('Categorías de Interés') }}" />
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2 mt-2">
                @foreach($categories as $category)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="selectedCategories" value="{{ $category->id }}" 
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="text-gray-700">{{ $category->name }}</span>
                    </label>
                @endforeach
            </div>
            <x-input-error for="selectedCategories" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Guardado.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled">
            {{ __('Guardar') }}
        </x-button>
    </x-slot>
</x-form-section>
