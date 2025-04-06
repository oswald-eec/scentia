<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Información del Perfil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actualice la información personal y las redes sociales de su perfil.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Campos de Perfil -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="title" value="{{ __('Título') }}" />
            <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="state.profile.title" />
            <x-input-error for="profile.title" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="biography" value="{{ __('Biografía') }}" />
            <textarea id="biography" class="mt-1 block w-full" rows="3" wire:model.defer="state.profile.biography"></textarea>
            <x-input-error for="profile.biography" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="website" value="{{ __('Sitio Web') }}" />
            <x-input id="website" type="url" class="mt-1 block w-full" wire:model.defer="state.profile.website" />
            <x-input-error for="profile.website" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="facebook" value="{{ __('Facebook') }}" />
            <x-input id="facebook" type="url" class="mt-1 block w-full" wire:model.defer="state.profile.facebook" />
            <x-input-error for="profile.facebook" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="youtube" value="{{ __('YouTube') }}" />
            <x-input id="youtube" type="url" class="mt-1 block w-full" wire:model.defer="state.profile.youtube" />
            <x-input-error for="profile.youtube" class="mt-2" />
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

