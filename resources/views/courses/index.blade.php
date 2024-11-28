<x-app-layout>
    {{-- Portada --}}

    <section class="bg-cover bg-center" style="background-image: url({{ asset('img/home/scentia_home.jpg') }});">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-36">
            <div class="w-full md:w-3/4 lg:w-1/2 mx-auto text-center">
                <h1 class="text-white font-bold text-4xl">Explora nuevos cursos y mejora tus habilidades</h1>
                <p class="text-white text-lg mt-2">El conocimiento no tiene límites, ¡explora nuestro catálogo y encuentra tu próximo desafío!</p>
    
                <div class="mt-6">
                    @livewire('search')
                </div>
            </div>
        </div>
    </section>
    

    @livewire('course-index')
</x-app-layout>